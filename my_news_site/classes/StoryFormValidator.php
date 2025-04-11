<?php
class StoryFormValidator extends FormValidator
{

    public function __construct($data = [], $files=[])
    {
        parent::__construct($data, $files);
    }

    public function validate()
    {

        // validate the form fields, placing any error messages in
        // $this->errors array

        // headline
        if (!$this->isPresent("headline")) {
            $this->errors['headline'] = "You must enter a headline";
        } else if (!$this->minLength("headline", 10)) {
            $this->errors['headline'] = "Headline must be at least 10 characters";
        } else if (!$this->maxLength("headline", 255)) {
            $this->errors["headline"] = "Please enter a headline with at most 255 characters";
        }

        // short headline
        if (!$this->isPresent("short_headline")) {
            $this->errors["short_headline"] = "You must enter a short headline";
        } else if (!$this->maxLength("short_headline", 128)) {
            $this->errors['headline'] = "Short headline must be at most 128 characters";
        }

        // article
        if (!$this->isPresent("article")) {
            $this->errors['article'] = "You must enter an article";
        } else if (!$this->minLength("article", 50)) {
            $this->errors['article'] = "Article must be at least 50 characters";
        }

        // image
        $maxFileSize = 1 * 1024 * 1024; // 1 MB
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!$this->hasFile("img_url")) {
            $this->errors["img_url"] = "Please choose an image";
        } else if (!$this->hasFileType("img_url", $allowedTypes)) {
            $this->errors["img_url"] = "Please choose a valid image type";
        } else if (!$this->hasFileSize("img_url", $maxFileSize)) {
            $this->errors["img_url"] = "Please choose an image with a size less than 1 MB";
        }

        // author
        $authors = Author::findAll();
        $validAuthors = array_map(function ($a) {
            return $a->id;
        }, $authors);
        if (!$this->isPresent("author_id")) {
            $this->errors['author_id'] = "You must choose an author";
        } else if (!$this->isElement("author_id", $validAuthors)) {
            $this->errors["author_id"] = "Please choose a valid author";
        }

        // category
        $categories = Category::findAll();
        $validCategories = array_map(function ($c) {
            return $c->id;
        }, $categories);
        if (!$this->isPresent("category_id")) {
            $this->errors['category_id'] = "You must choose a category";
        } else if (!$this->isElement("category_id", $validCategories)) {
            $this->errors["category_id"] = "Please choose a valid category";
        }

        // location
        $locations = Location::findAll();
        $validLocations = array_map(function ($l) {
            return $l->id;
        }, $locations);
        if (!$this->isPresent("location_id")) {
            $this->errors['location_id'] = "You must choose a location";
        } else if (!$this->isElement("location_id", $validLocations)) {
            $this->errors["location_id"] = "Please choose a valid location";
        }

        // creation date
        // if (!$this->isMatch("created_at", "/^([0-9]{4})-([0-9]{2})-([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})$/")) {
        //     $this->errors['created_at'] = 'INTERNAL ERROR created_at';
        // }

        // updated date
        // if (!$this->isMatch("updated_at", "/^([0-9]{4})-([0-9]{2})-([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})$/")) {
        //     $this->errors['updated_at'] = 'INTERNAL ERROR updated_at';
        // }

        return count($this->errors) === 0;
    }
}

?>