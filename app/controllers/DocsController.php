<?php

use LaravelRU\Docs\DocsUtil;

class DocsController extends BaseController {

	public function __construct()
	{
		
	}

	public function defaultDocs($name = "installation")
	{
        $default_version = Config::get("laravel.default_version");
        return Redirect::route("docs", [$default_version, $name]);
	}

	public function docs($version = "", $name = "installation")
	{
		if( ! in_array($version, Config::get("laravel.versions"))){

			// Запрошен универсальный урл типа /docs/installation - средиректить на /docs/5.0/installation
			$session_version = Session::get("docs_version");
			if( ! $session_version){
				$session_version = Config::get("laravel.default_version");
			}
			return Redirect::route("docs", [$session_version, $version]);
		}

		try{
			$page = Docs::version($version)->name($name)->firstOrFail();
		}catch(Exception $e){
			throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
		}

		Session::set("docs_version", $version);
		$menu = Docs::version($version)->name("documentation")->first();

		return View::make("docs/docpage", ['page'=>$page, 'menu'=>$menu, 'version'=>$version, 'name'=>$name]);
	}

	// список страниц с
	public function updates()
	{
		$docs = [];
		foreach(\Config::get("laravel.versions") as $version){
			$docs[$version] = Docs::version($version)->orderBy("name", "ASC")->get();
		}

		return View::make("docs/updates", compact("docs"));
	}

	
	
}