<?php

require_once('../app/core/controller.php');

class Products extends Controller
{
    /**
     * index
     * load the User model and load the home view
     * @return view home
     */
    public function index()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin();

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        $table = $this->loadModel('DTables');
        $alltables = $table->getAllTables();
        $htmltables = $table->makeFrontProducts($allProducts);
        $data['htmltables'] = $htmlProducts;

        if (strlen($htmlProducts) == 0) {
            $data['htmltables'] = "Il n'y a aucun Table pour ce date dans notre restaurant. Revenez plus tard ! ";
        }

        $data['pageTitle'] = "Produits";
        $this->view("products", $data);
    }

    /**
     * details
     * get the data about the product and load the detailsProduct view
     * @param  int $idProduct
     * @return view detailsProduct
     */
    public function details($idProduct)
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin();

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        //get the datas about the produt
        $product = $this->loadModel('Product');
        $singleProduct = $product->getOneProduct($idProduct);

        $data['product'] = $singleProduct[0];
        $data['pageTitle'] = "Details Produit";
        $this->view("detailsProduct", $data);
    }
}