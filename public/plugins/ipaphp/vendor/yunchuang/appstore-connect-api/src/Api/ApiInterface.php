<?php

namespace MingYuanYun\AppStore\Api;


interface ApiInterface
{
	public function getPerPage();

    public function setPerPage($perPage);
}