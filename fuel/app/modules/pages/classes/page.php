<?php

namespace Pages;

class Page
{
    protected $_short_code                  = null;     // The Short code for the page used in the URL
    protected $_latest_revision_date_time   = null;     // The revision for the current page
    protected $_this_revision_date_time     = null;     // The revision we are currently viewing
    protected $_page_options                = null;     // Array storing the page options (Serialized for Database)
    protected $_title                       = null;     // The page title
    protected $_content                     = null;     // Content to be sent back to the visitor


    // Serialize the given array
    protected function serializeArray($array=null)
    {
        if (!is_null($array))
        {
            return serialize($array);
        }
        else
        {
            return "";
        }
    }

    // Unserialise the given string
    protected function unserializeArray($string=null)
    {
        if (!is_null($array))
        {
            return unserialize($string);
        }
        else
        {
            return array();
        }
    }

    // Load in all the required page details into the class
    protected function _load()
    {
        $pageDetails = Model_Page::load($this->_short_code);

        $this->_page_options = $this->unserializeArray($pageDetails["options"]);
        $this->_title = $pageDetails["title"];
        $this->_content = $pageDetails["content"];

    }

    // Create a new class based on the details that have been given
    protected function _new($details)
    {

    }

    // *** Loading functions beyond this point ***

    // Load an existing page
    public function load($shortCode=null)
    {
        return new \Pages\Page(null, $shortCode);
    }

    // Create a new page
    public function __construct($details=null, $shortCode=null)
    {
        if (is_null($details) && is_null($shortCode))
        {
            throw new \Exception("No page information given");
        }
        else if (is_null($details) && !is_null($shortCode))
        {
            $this->_short_code = $shortCode;
            $this->_load();
        }
        else
        {
            $this->_new($details);
        }
    }

}