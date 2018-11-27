<?php

/*
Created by: Michel Gutardo Ramos de Lima
*/

class index {

    //PROPERTIES
    private $page = "index";
    private $title = "DON'T REPEAT YOUR PAGES";
    private $content;
    private $valid_pages = array(
        "about",
    );


    //CLASS CONSTRUCTOR
    public function __construct($page) {
        $this->page = $page;
        $this->setConfig();
        $this->getPage();

    }

    //Get all parts of the page
    private function getPage(){
      echo('<!DOCTYPE html>'."\n");
      echo('<html lang="pt">'."\n");
      $this->head();
      $this->body();
      echo('</html>');

    }

    //Check if page is a valid page
    private function setConfig() {
        if (!(in_array($this->page, $this->valid_pages))) {
           
            //default page 
            $this->page = "about";

        }
    }

    //TAG HEAD
    private function head() {
        echo("<head>\n");

        //Metas
        echo(file_get_contents("pages/common/meta.html"));

        //Favicon
        $this->getFavicon();

        //Title
        $this->getTitle();

        //Css
        $this->getCss();

        //JS loaded before page
        $this->getBeforeJs();

        echo("</head>");
    }

    //TAG BODY
    private function body() {
        echo('<body>'."\n");

        $this->getAside();

        $this->getHeader();

        $this->getContent();

        $this->getFooter();

        $this->getAfterJs();

        echo('</body>'."\n");

    }

    //TAG FOR ASIDE
    private function getAside() {
        echo(file_get_contents("pages/common/aside.html"));

    }

    //TAG FOR HEADER
    private function getHeader() {
        echo(file_get_contents("pages/common/header.html"));

    }

    //TAG FOR CONTENT
    private function getContent() {
        echo(file_get_contents("pages/content/{$this->page}.html"));

    }

    //TAG FOR FOOTER
    private function getFooter() {
        echo(file_get_contents("pages/common/footer.html"));

    }

    //ADD CSS 
    private function getCss() {

        echo(file_get_contents("pages/css/css.html"));
        switch($this->page){
          case "about":
	        /* Add especific css of "about" page */
            break;

          default:
            /* Add generic css */
            break;
        }

    }

    //ADD JS LOADED BEFORE ALL PAGE 
    private function getBeforeJs() {
        echo(file_get_contents("pages/js/before_load_js.html"));
        switch($this->page){
            case "about":
                 /* Add especific js of "about" page */
              break;
            default:
              /* Add especific js of "about" page */
              break;
            }
  
    }

    //ADD JS LOADED AFTER ALL PAGE 
    private function getAfterJs() {
        echo(file_get_contents("pages/js/after_load_js.html"));
        switch($this->page){
          case "about":
               /* Add especific js of "about" page */
            break;
          }

    }

    //ADD FAVICON
    private function getFavicon(){
      echo('<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />' );

    }

    //ADD PAGE TITLE
    private function getTitle() {
        switch ($this->page) {
            case "about":
                $this->title.= " - About";
                break;

        }

        echo("<title>{$this->title}</title>\n");

    }

}


//NEW INSTANCE OF INDEX
$page = new index( $_GET['page']);