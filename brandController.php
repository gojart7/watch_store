<?php
include_once 'brandRepository.php';
include_once 'brandModel.php';

class BrandController{
    private $errorMessage;
    private $succedMessage;

    public function __construct(){
        $this->errorMessage="";
        $this->succedMessage="";
    }

    public function getAllBrands()  {
        $repo = new BrandRepository();
        return $repo->getAllBrands();
    }

    public function addBrand($name, $description) {
        $repo = new BrandRepository();
        if ($repo->addBrand($name, $description)) {
            $this->succedMessage = "Brand added successfully!";
        } else {
            $this->errorMessage = "Failed to add brand.";
        }
    }

    public function deleteBrand($id) {
        //later before delete check if is used 
        $repo = new BrandRepository();
        if ($repo->deleteBrand($id)) {
            $this->succedMessage = "Brand deleted successfully!";
        } else {
            $this->errorMessage = "Failed to delete brand.";
        }
    }

    public function getErrorMessage(){
        return $this->errorMessage;
    }

    public function getSuccedMessage(){
        return $this->succedMessage;
    }
}
?>