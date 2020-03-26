/**
 * @Author: JokenLiu <Jason>
 * @Date:   2018-01-24 23:11:43
 * @Email:  190646521@qq.com
 * @Project: Demon
 * @Filename: main.js
 * @Last modified by:   Jason
 * @Last modified time: 2018-01-31 14:56:29
 * @License: 北京乐维世纪网络科技有限公司开发者协议
 * @Copyright: DemonLive
 */


/*global Qiniu */
/*global plupload */
/*global FileProgress */
/*global hljs */

(function (obj) {
    var requestFileSystem = obj.webkitRequestFileSystem || obj.mozRequestFileSystem || obj.requestFileSystem;

    function onerror(message) {
        alert(message);
    }

    function log(d) {
        console.log(d);
    }

    function logObj(obj) {
        for (prop in obj) {
            console.log("属性 '" + prop + "' 为 " + obj[prop]);
        }
    }

    function getPlistValue(keyStr, plistStr) {
        var re = new RegExp("<key>" + keyStr + "</key>[\n]*.*<string>.*</string>");
        var mathces = plistStr.match(re);
        if (mathces && mathces.length > 0) {
            var txt = plistStr.match(re)[0];
            re = new RegExp("<key>.*</key>[\n]*.*<string>");
            txt = txt.replace(re, "");
            txt = txt.replace("</string>", "");
            return txt;
        }
        return null;

    }

    var model = (function () {
        var URL = obj.webkitURL || obj.mozURL || obj.URL;

        return {
            getEntries: function (file, onend, onerror) {
                zip.createReader(new zip.BlobReader(file), function (zipReader) {
                    zipReader.getEntries(onend);
                }, onerror);
            },
            getEntryFile: function (entry, creationMethod, onend, onprogress) {
                var writer, zipFileEntry;

                function getData() {
                    entry.getData(writer, function (blob) {
                        var blobURL = creationMethod == "Blob" ? URL.createObjectURL(blob) : zipFileEntry.toURL();
                        onend(blobURL);
                    }, onprogress);
                }

                if (creationMethod == "Blob") {
                    writer = new zip.BlobWriter();
                    getData();
                } else {
                    createTempFile(function (fileEntry) {
                        zipFileEntry = fileEntry;
                        writer = new zip.FileWriter(zipFileEntry);
                        getData();
                    });
                }
            }
        };
    })();

    var uploadFileHandle = function (uploadUrl, fd, callbackSuccess, callbackFail) {
        var xhr = new XMLHttpRequest();
        // 设置上传文件相关的事件处理函数
        // 上传文件
        xhr.open("POST", uploadUrl, true);
        xhr.overrideMimeType("application/octet-stream");
        xhr.send(fd);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {// 4 = "loaded"
                if (xhr.status == 200) {
                    Common.SuccessHandler($.parseJSON(xhr.responseText), callbackSuccess, callbackFail);
                } else {
                    Common.ErrorHandler(xhr.statusText, 0, callbackFail);
                }
            }
        };
    };

    var uploader = Qiniu.uploader({
        disable_statistics_report: false,
        runtimes: 'html5,flash,html4',
        browse_button: 'pickfiles',
        container: 'container',
        drop_element: 'container',
        max_file_size: '1000mb',
        flash_swf_url: 'bower_components/plupload/js/Moxie.swf',
        dragdrop: true,
        chunk_size: '4mb',
        multi_selection: !(moxie.core.utils.Env.OS.toLowerCase() === "ios"),
        uptoken_url: $('#uptoken_url').val(),
        uptoken_func: function () {
            var ajax = new XMLHttpRequest();
            ajax.open('GET', $('#uptoken_url').val(), false);
            ajax.setRequestHeader("If-Modified-Since", "0");
            ajax.send();

            if (ajax.status === 200) {
                var res = JSON.parse(ajax.responseText);
                console.log('custom uptoken_func:' + res.uptoken);
                $("#form").submit();
                return res.uptoken;
            } else {
                console.log('custom uptoken_func err');
                return '';
            }
        },
        domain: $('#domain').val(),
        get_new_uptoken: false,
        //downtoken_url: '/downtoken',
        unique_names: true,
        // save_key: true,
        // x_vars: {
        //     'id': '1234',
        //     'time': function(up, file) {
        //         var time = (new Date()).getTime();
        //         // do something with 'time'
        //         return time;
        //     },
        // },
        auto_start: false,
        log_level: 5,
        init: {
            'BeforeChunkUpload': function (up, file) {
                console.log("before chunk upload:", file.name);
            },
            'FilesAdded': function (up, files) {
                $('table').show();
                $('#success').hide();
                plupload.each(files, function (file) {
                    var re = /.*\.ipa$/gi;
                    var reApk = /.*\.apk$/gi;
                    if (!reApk.test(file.name) && !re.test(file.name)) {
                        layer.alert("上传的文件必须是.apk或.ipa!");
                        return;
                    }
                    var fileM = file.size / 1024 / 1024;
                    if (fileM > config.file_size) {
                        layer.alert("上传" + fileM + "以上的文件请联系管理员！")
                        return;
                    }
                    up.start();
                    var progress = new FileProgress(file, 'fsUploadProgress');
                    progress.setStatus("等待...");
                    progress.bindUploadCancel(up);
                    //console.log(i);
                    //console.log(file);
                    var apkIcon = /.*ic_launcher.png/gi;
                    var ipaIcon = /.*Icon.*.png/gi;
                    var logoImg = progress.fileProgressWrapper.find("img");
                    logoImg.load(function () {
                        logoImg.attr("isLoad", "1");
                    });
                    logoImg.error(function () {
                        logoImg.attr("isLoad", "0");
                    });
                    if (re.test(file.name)) {
                        model.getEntries(file.getSource().getSource(), function (entries) {

                            entries.forEach(function (entry) {
                                if (ipaIcon.test(entry.filename)) {
                                    entry.getData(new zip.Data64URIWriter(), function (dataURI) {
                                        //logoImg.attr('src',dataURI);
                                        progress.fileProgressWrapper.find("img").attr('src', dataURI);
                                    });
                                }

                            });
                        });
                    } else if (reApk.test(file.name)) {
                        model.getEntries(file.getSource().getSource(), function (entries) {
                            entries.forEach(function (entry) {
                                if (apkIcon.test(entry.filename)) {
                                    entry.getData(new zip.Data64URIWriter(), function (dataURI) {
                                        progress.fileProgressWrapper.find("img").attr('src', dataURI);
                                    });
                                }
                            });
                        });
                    }
                });
            },
            'BeforeUpload': function (up, file) {
                console.log("this is a beforeupload function from init");
                var progress = new FileProgress(file, 'fsUploadProgress');
                var chunk_size = plupload.parseSize(this.getOption(
                    'chunk_size'));
                if (up.runtime === 'html5' && chunk_size) {

                    progress.setChunkProgess(chunk_size);
                }
            },
            'UploadProgress': function (up, file) {
                var progress = new FileProgress(file, 'fsUploadProgress');
                var chunk_size = plupload.parseSize(this.getOption(
                    'chunk_size'));
                progress.setProgress(file.percent + "%", file.speed,
                    chunk_size);
            },
            'UploadComplete': function () {
                $('#success').show();
            },
            'FileUploaded': function (up, file, info) {

                var progress = new FileProgress(file, 'fsUploadProgress');
                var logoImg = progress.fileProgressWrapper.find("img");
                var findInfo = false;
                model.getEntries(file.getSource().getSource(), function (entries) {
                    entries.forEach(function (entry) {
                        var infoPlistFileRe = /.*\.app\/Info\.plist$/gi;
                        var aXMLFileRe = /AndroidManifest\.xml$/gi;
                        //log('infoPlistFileRe:'+infoPlistFileRe);
                        //IOS
                        if (!findInfo && infoPlistFileRe.test(entry.filename)) {
                            findInfo = true;
                            entry.getData(new zip.BlobWriter(), function (text) {
                                var fd = new FormData();

                                fd.append('upFile', text);
                                uploadFileHandle("/index.php/portal/Index/get_ipa_info?resultType=json", fd, function (result) {
                                    var map = result;
                                    var res = $.parseJSON(info.response);
                                    map["ipaFilePath"] = server + res.key;
                                    map["ipaSize"] = file.size;
                                    var filename = file.name.toString();
                                    var dotPosition = filename.lastIndexOf(".");
                                    if (dotPosition > -1) {
                                        map["appName"] = filename.slice(0, dotPosition);
                                    } else {
                                        map["appName"] = filename;
                                    }

                                    map["appType"] = 1;
                                    if (logoImg && logoImg.attr("isLoad") == "1") {
                                        map["appLogo"] = logoImg.attr("src");
                                    }

                                    map["appName"] = appInfo['CFBundleDisplayName'];
                                    map["appLogo"] = appInfo['icon'];

                                    Common.AjaxPost("/index.php/portal/Index/save_app_info1", map, undefined, function (data) {
                                        location.href = "/index.php/user/tube/editor/id/" + data;
                                        progress.setComplete(up, data);
                                    }, function (errMsg) {
                                        progress.setCancelled();
                                        progress.setStatus(errMsg);
                                    });
                                }, function (errMsg, errCode) {
                                    progress.setStatus("解析错误");
                                    progress.setCancelled(true);
                                    progress.fileProgressWrapper.find('.status').css('left', '0');
                                    up.removeFile(file);
                                });
                            });

                        } else if (!findInfo && aXMLFileRe.test(entry.filename)) {		//Android

                            var data = {};
                            entry.getData(new zip.BlobWriter(), function (text) {

                                var fd = new FormData();
                                fd.append('upFile', text);

                                uploadFileHandle("/index.php/portal/Index/get_apk_info?resultType=json", fd, function (result) {
                                    var map = result;
                                    var res = $.parseJSON(info.response);
                                    map["ipaFilePath"] = server + res.key;
                                    map["ipaSize"] = file.size;
                                    var filename = file.name.toString();
                                    var dotPosition = filename.lastIndexOf(".");
                                    if (dotPosition > -1) {
                                        map["appName"] = filename.slice(0, dotPosition);
                                    } else {
                                        map["appName"] = filename;
                                    }

                                    map["appType"] = 0;
                                    if (logoImg && logoImg.attr("isLoad") == "1") {
                                        map["appLogo"] = logoImg.attr("src");
                                    }

                                    map["appName"] = appInfo['application']['label'][0];
                                    map["appType"] = 0;
                                    map["appLogo"] = appInfo['icon'];
                                    map["identifier"] = appInfo['package'];
                                    map["version"] = appInfo['versionName'];
                                    map["versionCode"] = appInfo['versionCode'];

                                    Common.AjaxPost("/index.php/portal/Index/save_app_info", map, undefined, function (data) {
                                        console.log(data);
                                        //alert(data.data);
                                        location.href = "/index.php/user/tube/editor/id/" + data;
                                        progress.setComplete(up, data);
                                    }, function (errMsg) {
                                        progress.setCancelled();
                                        progress.setStatus(errMsg);
                                    });
                                }, function (errMsg, errCode) {
                                    progress.setStatus("解析错误");
                                    progress.setCancelled(true);
                                    progress.fileProgressWrapper.find('.status').css('left', '0');
                                    up.removeFile(file);
                                });
                            });
                        }
                    });
                });


            },
            'Error': function (up, err, errTip) {
                $('table').show();
                var progress = new FileProgress(err.file, 'fsUploadProgress');
                progress.setError();
                progress.setStatus(errTip);
            }
            // ,
            // 'Key': function(up, file) {
            //     var key = "";
            //     // do something with key
            //     return key
            // }
        }
    });
    // uploader.init();
    uploader.bind('BeforeUpload', function () {
        console.log("hello man, i am going to upload a file");
    });
    uploader.bind('FileUploaded', function () {

        var big = $(".progressFileSize").last().text();
        var name = $(".progressName").last().text();

    });
    $('#container').on(
        'dragenter',
        function (e) {
            e.preventDefault();
            $('#container').addClass('draging');
            e.stopPropagation();
        }
    ).on('drop', function (e) {
        e.preventDefault();
        $('#container').removeClass('draging');
        e.stopPropagation();
    }).on('dragleave', function (e) {
        e.preventDefault();
        $('#container').removeClass('draging');
        e.stopPropagation();
    }).on('dragover', function (e) {
        e.preventDefault();
        $('#container').addClass('draging');
        e.stopPropagation();
    });


    $('#show_code').on('click', function () {
        $('#myModal-code').modal();
        $('pre code').each(function (i, e) {
            hljs.highlightBlock(e);
        });
    });


    $('body').on('click', 'table button.btn', function () {
        $(this).parents('tr').next().toggle();

    });


    var getRotate = function (url) {
        if (!url) {
            return 0;
        }
        var arr = url.split('/');
        for (var i = 0, len = arr.length; i < len; i++) {
            if (arr[i] === 'rotate') {
                return parseInt(arr[i + 1], 10);
            }
        }
        return 0;
    };

    $('#myModal-img .modal-body-footer').find('a').on('click', function () {
        var img = $('#myModal-img').find('.modal-body img');
        var key = img.data('key');
        var oldUrl = img.attr('src');
        var originHeight = parseInt(img.data('h'), 10);
        var fopArr = [];
        var rotate = getRotate(oldUrl);
        if (!$(this).hasClass('no-disable-click')) {
            $(this).addClass('disabled').siblings().removeClass('disabled');
            if ($(this).data('imagemogr') !== 'no-rotate') {
                fopArr.push({
                    'fop': 'imageMogr2',
                    'auto-orient': true,
                    'strip': true,
                    'rotate': rotate,
                    'format': 'png'
                });
            }
        } else {
            $(this).siblings().removeClass('disabled');
            var imageMogr = $(this).data('imagemogr');
            if (imageMogr === 'left') {
                rotate = rotate - 90 < 0 ? rotate + 270 : rotate - 90;
            } else if (imageMogr === 'right') {
                rotate = rotate + 90 > 360 ? rotate - 270 : rotate + 90;
            }
            fopArr.push({
                'fop': 'imageMogr2',
                'auto-orient': true,
                'strip': true,
                'rotate': rotate,
                'format': 'png'
            });
        }

        $('#myModal-img .modal-body-footer').find('a.disabled').each(
            function () {

                var watermark = $(this).data('watermark');
                var imageView = $(this).data('imageview');
                var imageMogr = $(this).data('imagemogr');

                if (watermark) {
                    fopArr.push({
                        fop: 'watermark',
                        mode: 1,
                        image: 'http://www.b1.qiniudn.com/images/logo-2.png',
                        dissolve: 100,
                        gravity: watermark,
                        dx: 100,
                        dy: 100
                    });
                }

                if (imageView) {
                    var height;
                    switch (imageView) {
                        case 'large':
                            height = originHeight;
                            break;
                        case 'middle':
                            height = originHeight * 0.5;
                            break;
                        case 'small':
                            height = originHeight * 0.1;
                            break;
                        default:
                            height = originHeight;
                            break;
                    }
                    fopArr.push({
                        fop: 'imageView2',
                        mode: 3,
                        h: parseInt(height, 10),
                        q: 100,
                        format: 'png'
                    });
                }

                if (imageMogr === 'no-rotate') {
                    fopArr.push({
                        'fop': 'imageMogr2',
                        'auto-orient': true,
                        'strip': true,
                        'rotate': 0,
                        'format': 'png'
                    });
                }
            });

        var newUrl = Qiniu.pipeline(fopArr, key);

        var newImg = new Image();
        img.attr('src', 'images/loading.gif');
        newImg.onload = function () {
            img.attr('src', newUrl);
            img.parent('a').attr('href', newUrl);
        };
        newImg.src = newUrl;
        return false;
    });

})(this);
