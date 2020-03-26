/** 项目公共js **/
/**
 * 服务器返回状态
 */
var ServerResponseState={
    success:1,		//执行成功标志
    fail:0,			//执行失败，原因见retMsg
    notLogin:2,	//未登录
    noPermission:3	//没有权限
}
String.prototype.startWith = function(compareStr){
    return this.indexOf(compareStr) == 0;
}
var saveIndex;
/**
 * 公用js类
 */
var Common={
    shade:[0.3, '#393D49'],
    /**
     * ajax的Get请求
     * @param url 请求地址
     * @param callback_success 执行成功回调函数 function(data)
     * @param callback_fail 失败执行回调函数 function(errMsg,errCode)
     */
    AjaxGet:function(url,callback_before,callback_success,callback_fail){
        $.ajax({
            type:"GET",
            url:url,
            dataType:"json",
            beforeSend:function(){
                if(callback_before!=undefined){
                    callback_before();
                }
            },
            success:function(result){
                Common.SuccessHandler(result,callback_success,callback_fail);
            },
            error:function(){
                Common.ErrorHandler(undefined,undefined,callback_fail);
            }
        });
    },
    /**
     * 同步的Get请求
     * @param url 请求地址
     * @param callback_success 执行成功回调函数 function(data)
     * @param callback_fail 失败执行回调函数 function(errMsg,errCode)
     */
    SynsGet:function(url,callback_before,callback_success,callback_fail){
        $.ajax({
            type:"GET",
            url:url,
            dataType:"json",
            async:false,
            beforeSend:function(){
                if(callback_before!=undefined){
                    callback_before();
                }
            },
            success:function(result){
                Common.SuccessHandler(result,callback_success,callback_fail);
            },
            error:function(){
                Common.ErrorHandler(undefined,undefined,callback_fail);
            }
        });
    },
    /**
     * Ajax的post提交
     * @param url 提交url
     * @param postData 提交数据
     * @param callback_before 提交前执行函数
     * @param callback_success	执行成功回调函数 function(data)
     * @param callback_fail 执行失败回调函数 function(errMsg,errCode)
     */
    AjaxPost:function(url,postData,callback_before,callback_success,callback_fail){
        $.ajax({
            type:"POST",
            url:url,
            data:postData,
            async:false,
            dataType:"json",
            beforeSend:function(){
                if(callback_before!=undefined){
                    callback_before();
                }
            },
            success:function(result){
                Common.SuccessHandler(result,callback_success,callback_fail);
            },
            error:function(){
                Common.ErrorHandler(undefined,undefined,callback_fail);
            }
        });
    },
    /**
     * Ajax的post提交
     * @param url 提交url
     * @param postData 提交数据
     * @param callback_before 提交前执行函数
     * @param callback_success	执行成功回调函数 function(data)
     * @param callback_fail 执行失败回调函数 function(errMsg,errCode)
     */
    SyncPost:function(url,postData,callback_before,callback_success,callback_fail){
        $.ajax({
            type:"POST",
            url:url,
            data:postData,
            dataType:"json",
            beforeSend:function(){
                if(callback_before!=undefined){
                    callback_before();
                }
            },
            success:function(result){
                Common.SuccessHandler(result,callback_success,callback_fail);
            },
            error:function(){
                Common.ErrorHandler(undefined,undefined,callback_fail);
            }
        });
    },
    /**
     * 表单ajax提交绑定
     * @param formId 表单id，#为非必须
     * @param callback_before 提交前执行函数，如执行后不提交，返回false
     * @param callback_success 提交成功回调函数 function(data)
     * @param callback_fail 提交失败回调函数 function(errMsg,errCode)
     */
    AjaxSubmitBind:function(formId,callback_before,callback_success,callback_fail,tiptype){
        if(tiptype==1){
            tiptype=function(msg,o,cssctl){
                var objtip=$("#errorTip");
                cssctl(objtip,o.type);
                objtip.text(msg);
            };
        }
        callback_before=(callback_before===undefined?function(){}:callback_before);
        tiptype=(tiptype===undefined?2:tiptype);
        var validateForm=$(Common.GetId(formId)).Validform();
        validateForm.config({
            tiptype:tiptype,
            ajaxPost:true,
            postonce:true,
            beforeSubmit:function(){
                saveIndex=Common.Loading();
                if(callback_before!=undefined){
                    callback_before();
                }
            },
            showAllError:true,
            ajaxpost:{
                success:function(result){
                    validateForm.resetStatus();
                    Common.SuccessHandler(result,callback_success,callback_fail);
                },
                error:function(){
                    Common.ErrorHandler(undefined,undefined,callback_fail);
                }
            }
        });
        return validateForm;
    },
    /**
     * 表单ajax提交绑定
     * @param formId 表单id，#为非必须
     * @param callback_before 提交前执行函数，如执行后不提交，返回false
     */
    SubmitBind:function(formId,callback_before,tiptype){
        if(tiptype==1){
            tiptype=function(msg,o,cssctl){
                var objtip=$("#errorTip");
                cssctl(objtip,o.type);
                objtip.text(msg);
            };
        }
        callback_before=(callback_before===undefined?function(){}:callback_before);
        tiptype=(tiptype===undefined?2:tiptype);
        var validateForm=$(Common.GetId(formId)).Validform();
        validateForm.config({
            tiptype:tiptype,
            postonce:true,
            beforeSubmit:callback_before,
            showAllError:true
        });
        return validateForm;
    },
    /**
     * 重置表单
     * @param formId
     */
    ResetForm:function(formId){
        $(Common.GetId(formId)).Validform().resetForm();
    },
    /**
     * 清空表单
     * @param formId
     */
    ClearForm:function(formId){
        $(Common.GetId(formId)).Validform().clearForm();
    },
    /**
     * 获取dom的ID
     * @param id 标签名，如：saveForm或#saveForm
     * @returns
     */
    GetId:function(id){
        if(id.indexOf("#")==0){
            return id;
        }else{
            return "#"+id;
        }
    },
    /**
     * 成功处理函数
     * @param result
     * @param callback_success
     * @param callback_fail
     */
    SuccessHandler:function(result,callback_success,callback_fail){
        if(saveIndex){
            Common.Close(saveIndex);
            parent.Common.Close(saveIndex);
        }

        if(result.retCode==ServerResponseState.success){
            if(callback_success!=undefined){
                callback_success(result.data);
            }else{
                Common.TipSuccess("操作成功");
            }
        }else if(result.retCode==ServerResponseState.notLogin){
            Common.Open("请登录",baseUrl+"/login?type=short");
        }else{
            Common.ErrorHandler(result.retMsg,result.retCode,callback_fail);
        }
    },
    /**
     * 失败处理函数
     * @param errMsg 错误信息
     * @param callback_fail 处理函数
     */
    ErrorHandler:function(errMsg,errCode,callback_fail){
        if(saveIndex){
            Common.Close(saveIndex);
            parent.Common.Close(saveIndex);
        }
        errMsg=(errMsg===undefined?"操作失败":errMsg);
        if(errCode==ServerResponseState.noPermission){
            Common.AlertFail("您没有该操作权限");
            return;
        }
        if(callback_fail!=undefined){
            callback_fail(errMsg,errCode);
        }else{
            if(errCode==ServerResponseState.noPermission){
                Common.AlertFail("您没有该操作权限");
            }else{
                Common.AlertFail(errMsg);
            }
        }
    },
    /**
     * 跳转页面
     * @param url
     */
    Redirect:function(url){
        window.location.href=url;
    },
    /**
     * 普通信息框
     * @param message 消息内容
     * @param callback 回调函数,function(index) 样式
     */
    Alert:function(message,callback){
        if(parent){
            parent.layer.alert(message,function(index){
                parent.Common.Close(index);
                if(callback!=undefined){
                    callback(index);
                }

            });
        }else{
            layer.alert(message,function(index){
                Common.Close(index);
                if(callback!=undefined){
                    callback(index);
                }

            });
        }

    },
    /**
     * 普通信息框
     * @param message 消息内容
     * @param callback 回调函数,function(index) 样式
     */
    AlertSuccess:function(message,callback){
        if(parent){
            parent.layer.alert(message,{icon: 6},function(index){
                parent.Common.Close(index);
                if(callback!=undefined){
                    callback(index);
                }

            });
        }else{
            layer.alert(message,{icon: 6},function(index){
                Common.Close(index);
                if(callback!=undefined){
                    callback(index);
                }

            });
        }
    },
    /**
     * 普通信息框
     * @param message 消息内容
     * @param callback 回调函数,function(index) 样式
     */
    AlertFail:function(message,callback){
        if(parent){
            parent.layer.alert(message,{icon: 5},function(index){
                parent.Common.Close(index);
                if(callback!=undefined){
                    callback(index);
                }

            });
        }else{
            layer.alert(message,{icon: 5},function(index){
                Common.Close(index);
                if(callback!=undefined){
                    callback(index);
                }

            });
        }

    },
    /**
     * 提示
     * @param message
     */
    Tip:function(message,callback){
        if(parent){
            parent.layer.msg(message,callback);
        }else{
            layer.msg(message,callback);
        }

    },
    /**
     * 提示
     * @param message
     */
    TipId:function(message,tipId){
        layer.tips(message,Common.GetId(tipId),{tips:[4,"#78BA32"]});
    },
    /**
     * 提示成功
     * @param message
     */
    TipSuccess:function(message,callback){
        if(parent){
            parent.layer.msg(message, {icon: 1,time:2000},callback);
        }else{
            layer.msg(message, {icon: 1,time:2000},callback);
        }

    },
    /**
     * 提示失败
     * @param message
     */
    TipFail:function(message,callback,width){
        if(parent){
            parent.layer.msg(message, {icon: 5,time:2000},callback);
        }else{
            layer.msg(message, {icon: 5,time:2000},callback);
        }

    },
    /**
     * 询问框
     * @param message
     * @param title 标题，默认“请确认”
     * @param callback 回调函数，function(index){ }
     */
    Confirm:function(title,message,callback){
        title=(title===undefined?"请确认":title);
        if(parent){
            parent.layer.confirm(message, {icon: 3, title:title},function(index){
                Common.Close(index);
                if(callback!=undefined){
                    callback(index);
                }

            });
        }else{
            layer.confirm(message, {icon: 3, title:title},function(index){
                Common.Close(index);
                if(callback!=undefined){
                    callback(index);
                }

            });
        }

    },
    /**
     * 加载层
     * @param msg 加载提示消息
     * @param func 加载执行函数 function(index)
     * @param maxTime
     */
    Loading:function(msg,func,maxTime){
        var index;
        if(parent){
            if(msg!=undefined){
                index=parent.layer.msg(msg, {icon: 16,time: 0,shade:Common.shade,shadeClose:false});
            }else{
                if(maxTime!=undefined){
                    index=parent.layer.load(1,{time:maxTime,shade:Common.shade,shadeClose:false});
                }else{
                    index=parent.layer.load(1,{shade:Common.shade,shadeClose:false});
                }
            }
            if(func!=undefined){
                func(index);
            }
            return index;
        }else{
            if(msg!=undefined){
                index=layer.msg(msg, {icon: 16,time: 0,shade:Common.shade,shadeClose:false});
            }else{
                if(maxTime!=undefined){
                    index=layer.load(1,{time:maxTime,shade:Common.shade,shadeClose:false});
                }else{
                    index=layer.load(1,{shade:Common.shade,shadeClose:false});
                }
            }
            if(func!=undefined){
                func(index);
            }
            return index;
        }

    },
    /**
     * 回退
     */
    GoBack:function(){
        history.back();
    },
    /**
     * 刷新页面
     */
    Reload:function(){
        location.reload();
    },
    /**
     * 刷新iframe
     * @param id
     */
    ReloadIframe:function(id){
        if(parent){
            parent.document.getElementById(id).contentWindow.location.reload(true);
        }else{
            document.getElementById(id).contentWindow.location.reload(true);
        }

    },
    /**
     * 打开窗口
     * @param title
     * @param url
     * @param w
     * @param h
     * @param isOpenMax 是否打开即最大化
     */
    Open:function(title,url,w,h,isOpenMax,maxmin){
        var isMobile = device.mobile(),
            isTable = device.tablet();
        if(isMobile || isTable){
            isOpenMax=true;
        }
        if (w == undefined || w == '') {
            w='500px';
        }else{
            w=w+'px';
        }
        if (h == undefined || h == '') {
            h='400px';
        }else{
            h=h+'px';
        }
        if (maxmin==undefined){
            maxmin=true;
        }
        if (title == undefined || title == '') {
            title=false;
        };
        if (url == undefined || url == '') {
            url=baseUrl+"/404.html";
        };
        if(isOpenMax===undefined && device.mobile()){
            isOpenMax=true;
        }else if(isOpenMax===undefined){
            isOpenMax=false;
        }
        if(parent){
            openIndex=parent.layer.open({
                type: 2,
                content:url,
                shadeClose: false,
                title: title,
                maxmin:maxmin,
                closeBtn: 1,
                shade: Common.shade,
                area: [w, h],
                scrollbar: false
            });
            parent.openIndex=openIndex;
            if(isOpenMax){
                parent.layer.full(openIndex);
            }
        }else{
            openIndex=layer.open({
                type: 2,
                content:url,
                shadeClose: false,
                title: title,
                maxmin:maxmin,
                closeBtn: 1,
                shade: Common.shade,
                area: [w, h],
                scrollbar: false
            });
            if(isOpenMax){
                layer.full(openIndex);
            }
        }

    },
    /**
     * 打开页内元素
     * @param id
     */
    OpenId:function(title,id,w,h,isOpenMax){
        if (w == null || w == '') {
            w='500px';
        }else{
            w=w+'px';
        }
        if (h == null || h == '') {
            h='400px';
        }else{
            h=h+'px';
        }

        if (title == null || title == '') {
            title=false;
        };
        if(isOpenMax===undefined){
            isOpenMax=false;
        }
        openIndex=layer.open({
            type:1,
            title: title,
            maxmin:true,
            closeBtn: 1,
            area: [w, h],
            content:$(Common.GetId(id))
        })
        if(isOpenMax){
            layer.full(openIndex);
        }
    },
    /**
     * 暂停时间，以秒为单位
     * @param time 秒
     * @param callback 回调函数
     */
    Pause:function(time,callback){
        time=(time===undefined?2000:time*1000);
        if(callback!=undefined){
            setTimeout(callback,time);
        }else{
            var njf1 = njen(this,arguments,"millis");
            nj:while(1) {
                try{
                    switch(njf1.cp) {
                        case 0:njf1._notifier=NjsRuntime.createNotifier();
                            setTimeout(njf1._notifier,njf1._millis);
                            njf1.cp = 1;
                            njf1._notifier.wait(njf1);
                            return;
                        case 1:break nj;
                    }
                }
                catch(ex) {
                    if(!njf1.except(ex,1))
                        return;
                }
            }
            njf1.pf();
        }
    },
    /**
     * 关闭窗口，如不填index，关闭所有窗口
     * @param index
     */
    Close:function(index){
        if(index!=undefined){
            layer.close(index);
        }else{
            layer.closeAll();
        }
    },
    /**
     * 关闭本窗口
     */
    CloseSelf:function(){
        parent.layer.close(parent.openIndex);
    },
    /**
     * 关闭所有
     * @param type
     */
    CloseAll:function(type){
        layer.closeAll(type);
    },
    /**
     * 通用删除函数
     * @param url
     */
    Delete:function(url,width){
        width=(width===undefined?'400':width);
        Common.Confirm("请确认","删除不可恢复，请确认是否删除？",function(index){
            Common.AjaxGet(url,function(){
                Common.Close(index);
                saveIndex=Common.Loading("正在删除中……");
            },function(data){
                Common.TipSuccess("删除成功");
                Common.Pause(1,function(){
                    Common.Reload();
                });
            });
        },width);
    },
    /**
     * 批量删除
     * @param checkboxName
     * @param url
     * @param postName
     */
    DeleteMult:function(checkboxName,url,postName,width){
        width=(width===undefined?'400':width);
        postName=(postName===undefined?"ids":postName);
        var idsStr="";
        var isFirst=true;
        $("input[name="+checkboxName+"]:checked").each(function(){
            if(isFirst){
                idsStr+=$(this).val();
                isFirst=false;
            }else{
                idsStr+=","+$(this).val();
            }
        });
        if(idsStr.length==0){
            Common.Alert("请选择要删除的数据");
            return;
        }
        if(url.indexOf("?")>-1){
            url=url+"&"+postName+"="+idsStr;
        }else{
            url=url+"?"+postName+"="+idsStr;
        }
        Common.Delete(url,width);
    },
    /**
     * 通用操作函数，by Zhoudc
     * @param url
     * @param handleName 操作名称
     * @param callback 回调函数
     * @param width 宽度
     */
    Handle:function(url,handleName,callback,width){
        width=(width===undefined?"400":width);
        handleName=(handleName===undefined?"操作":handleName);
        Common.Confirm("请确认","请确认是否"+handleName+"？",function(index){
            Common.AjaxGet(url,function(){
                Common.Close(index);
                saveIndex=Common.Loading("正在"+handleName+"中……");
            },function(data){
                Common.TipSuccess(handleName+"成功",width);
                Common.Pause(1,function(){
                    if(callback!=undefined){
                        callback();
                    }
                });
            });
        },width);
    },
    /**
     * 批量操作
     * @param checkboxName
     * @param url
     * @param postName
     * @param callback 回调函数
     */
    HandleMult:function(checkboxName,url,postName,handleName,callback,width){
        width=(width===undefined?"400":width);
        postName=(postName===undefined?"ids":postName);
        var idsStr=Common.GetSelectIds(checkboxName);
        if(idsStr.length==0){
            Common.Alert("请选择要"+handleName+"的数据");
            return;
        }
        if(url.indexOf("?")>-1){
            url=url+"&"+postName+"="+idsStr;
        }else{
            url=url+"?"+postName+"="+idsStr;
        }
        Common.Handle(url,handleName,callback,width);
    },
    /**
     * 获取选中的项
     * @param checkboxName
     * @returns {String}
     */
    GetSelectIds:function(checkboxName){
        var idsStr="";
        var isFirst=true;
        $("input[name="+checkboxName+"]:checked").each(function(){
            if(isFirst){
                if($(this).val()!=""){
                    idsStr+=$(this).val();
                    isFirst=false;
                }

            }else{
                idsStr+=","+$(this).val();
            }
        });
        return idsStr;
    },
    /**
     * 通用方法:当前页面提交,结果返回当前页面
     * @author liuzw
     * @param operateTip
     * @param fromId
     */
    AjaxPostSubmitBind:function(fromId,operateTip,tiptype){
        fromId=(fromId===undefined?"saveForm":fromId);
        Common.AjaxSubmitBind(fromId,function(){
            saveIndex=Common.Loading("正在"+operateTip+"中……");
        },function(data){
            Common.TipSuccess(operateTip+"成功");
            Common.Pause(1,function(){
                Common.Reload();
            });
        },function(errMsg,errCode){
            Common.Alert(errMsg);
        },tiptype);
    },
    /**
     * 搜集表单数据，返回map
     * @author liuzw
     * @param id form的id
     */
    CollectForm:function(id){
        map={};
        $(Common.GetId(id)).find("input[name!=''],select[name!=''],textarea[name!=''],input:radio:checked").each(function(){
            if($(this).attr("name") && $(this).val()!=""){
                map[$(this).attr("name")]=$(this).val();
            }
        });
        return map;
    },
    /**
     * 当前页面跳转
     */
    GoUrl:function(url){
        window.location.href=url;
    },
    /**
     * 打开新页面
     */
    OpenWindow:function(url){
        window.open(url);
    },
    /**
     * 全选
     * @param checkName
     * @param checkState
     */
    CheckAll:function(obj,checkName){
        var checkState=$(obj).find("i").hasClass("fa-check-square-o");
        if(checkState){
            $(obj).find("i").removeClass("fa-check-square-o");
            $(obj).find("i").addClass("fa-square-o");
        }else{
            $(obj).find("i").addClass("fa-check-square-o");
            $(obj).find("i").removeClass("fa-square-o");
        }
        $("input[name="+checkName+"]").prop("checked",!checkState);
    },
    /**
     * 获取绝对url
     * @param url
     * @returns
     */
    GetUrl:function(url){
        if(!url){
            return "";
        }
        if(!(url.indexOf("http://")==0 || url.indexOf("https://"))){
            url=baseUrl+url;
        }
        return url;
    },
    /**
     * 获取图片url地址
     * @param url
     * @param width
     * @param height
     * @returns
     */
    GetImageUrl:function(url,width,height){
        url=Common.GetUrl(url);
        url+="?imageView2/1";
        if(width!=undefined){
            url+="/w/"+width;
        }
        if(height!=undefined){
            url+="/h/"+height;
        }
        return url;
    }
}
//消息提醒
var newMessageRemind = function () {
    var i = 0,
        title = document.title,
        loop;

    return {
        show: function (tip) {
            loop = setInterval(function () {
                i++;
                if ( i == 1 ) document.title = '【'+tip+'】' + title;
                if ( i == 2 ) document.title = '【　　　】' + title;
                if ( i == 3 ) i = 0;
            }, 800);
        },
        stop: function () {
            clearInterval(loop);
            document.title = title;
        }
    };
} ();