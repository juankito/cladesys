<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('logistics/productmodel');
    }

    /**
     * This function creates a query and sends it to the model
     * @return a view of product.
     */
    public function index()
    {
        $select = array(    
            'id'        => 'product.id',
            'category'  => 'category.name as category',
            'brand'     => 'brand.name as brand',
            'detail'    => 'product.detail',
            'barcode'   => 'product.barcode'
        );  
        $from = array(  
            'table' => 'product',
        );  
        $join = array(  
            'table1' => 'category ',
            'condition1' => 'category.id = product.categoryid',
            'table2' => 'brand ',
            'condition2' => 'brand.id = product.brandid'
        );
        $where = array('product.flagstate' => 1);

        $products =  $this->productmodel->get_items($select, $from, $join, $where, false);

        $data = array('product' => $products);

        return $this->load->view('logistics/product/index', $data);
    }

    public function show($id){
        //This part returns the product features.
        $select = array( 
            'id'        => 'product.id',
            'category'  => 'category.name as category',
            'brand'     => 'brand.name as brand',
            'detail'    => 'product.detail',
            'status'    => 'product.status',
            'barcode'   => 'product.barcode',
            'minstock'  => 'product.minstock',
            'updated'   => 'product.updated_at as updated'
            );  
        $from = array(  
            'table' => 'product'
            );  
        $join = array(  
            'table1'        => 'category ',
            'condition1'    => 'category.id = product.categoryid',
            'table2'        => 'brand ',
            'condition2'    => 'brand.id = product.brandid'
            );
        $where = array('product.id' => $id);

        $products = $this->productmodel->get_items($select, $from, $join, $where, false);

        //This part returns the packing features
        $this->load->model('logistics/packingmodel');
        $select = array(    
            'id'        => 'packing.id',
            'name'      => 'packs.name',
            'factor'    => 'packing.factor',
            'parent'    => 'p2.name as parent'
            );  
        $from = array(  
            'table' => 'product',
            );  
        $join = array( 
            'table1'        => 'packing',
            'condition1'    => 'packing.id = product.packingid',
            'table2'        => 'packs',
            'condition2'    => 'packs.id = packing.packsid',
            'table3'        => 'packing as p1',
            'condition3'    => 'p1.id = packing.packingid',
            'table4'        => 'packs as p2',
            'condition4'    => 'p2.id = p1.packsid'
            );
        $where = array('product.id' => $id);

        $packs = $this->packingmodel->get_items($select, $from, $join, $where, false);

        //This returns the stock values.
        $select = array(
            'productid' => 'inputdetail.productid',
            'unitprice' => 'inputdetail.unitprice',
            'fabdate'   => 'inputdetail.fabdate',
            'expire'    => 'inputdetail.expiredate',
            'lot'       => 'inputdetail.lot',
            'id'        => 'stock.id',
            'quantity'  => 'stock.quantity',
            'change'    => 'stock.outchange',
            'location'  => 'location.name',
             );
        $from = array('table' => 'inputdetail');
        $join = array(
                'table1'       => 'stock',
                'condition1'   => 'stock.inputdetailid = inputdetail.id',
                'table2'        => 'location',
                'condition2'    => 'location.id = stock.locationid'
            );
        $where = array('inputdetail.productid' => $id);

        $stocks = $this->productmodel->get_items($select, $from, $join, $where, false);

        $data = array(
            'product'   => $products,
            'pack'      => $packs,
            'stock'     => $stocks
            );

        return $this->load->view('logistics/product/show', $data);
    }

    public function edit($id)
    {
        $select = array( 
            'id'        => 'product.id',
            'category'  => 'product.categoryid',
            'brand'     => 'product.brandid',
            'packing'   => 'product.packingid',
            'detail'    => 'product.detail',
            'status'    => 'product.status',
            'barcode'   => 'product.barcode',
            'minstock'  => 'product.minstock',
            'updated'   => 'product.updated_at as updated'
            );  
        $from = array(  
            'table' => 'product'
            );  
        $where = array('product.id' => $id);

        $products = $this->productmodel->get_items($select, $from, false, $where, false);

        $select = array(
            'category' => array(
                'id'    => 'category.id',
                'name'  => 'category.name'
                ),
            'brand' => array(
                'id'    => 'brand.id',
                'name'  => 'brand.name'
                )
            );
        $from = array(
                'category'  => 'category',
                'brand'     => 'brand'
            );
        $where = array('flagstate' => 1);

        $brands = $this->productmodel->get_items($select['brand'], $from['brand'], false, $where, false);
        $categories = $this->productmodel->get_items($select['category'], $from['category'], false, $where, false);
        
        $this->load->model('logistics/packingmodel');
        $select = array(    
            'id'        => 'packing.id',
            'name'      => 'packs.name',
            'factor'    => 'packing.factor',
            'parentid'  => 'packing.packingid',
            'parent'    => 'p2.name as parent'
            );  
        $from = array(  
            'table' => 'product',
            );  
        $join = array( 
            'table1'        => 'packing',
            'condition1'    => 'packing.id = product.packingid',
            'table2'        => 'packs',
            'condition2'    => 'packs.id = packing.packsid',
            'table3'        => 'packing as p1',
            'condition3'    => 'p1.id = packing.packingid',
            'table4'        => 'packs as p2',
            'condition4'    => 'p2.id = p1.packsid'
            );
        $where = array('product.id' => $id);

        $packs = $this->packingmodel->get_items($select, $from, $join, $where, false);

        $data = array(
            'brand'     => $brands, 
            'category'  => $categories,
            'pack'      => $packs,
            'product'   => $products
            );

        return $this->load->view('logistics/product/edit', $data);
    }

    public function update($id)
    {
        $category   = $this->input->post('category');
        $brand      = $this->input->post('brand');
        $packing    = $this->input->post('pack');
        $detail     = $this->input->post('detail');
        $minstock   = $this->input->post('minimum');
        $state      = $this->input->post('state');
        $barcode    = $this->input->post('barcode');

        $product = array();

        if (!empty($category)){
            $product['categoryid'] = $category;
        }
        if (!empty($brand)){
            $product['brandid'] = $brand;
        }
        if (!empty($packing)){
            $product['packingid'] = $packing;
        }
        if (!empty($detail)){
            $product['detail'] = $detail;
        }
        if (!empty($minstock)){
            $product['minstock'] = $minstock;
        }
        if (!empty($state)){
            $product['state'] = $state;
        }
        if (!empty($barcode)){
            $product['barcode'] = $barcode;
        }

        $where = array('product.id' => $id, 'product.flagstate' => 1);

        try {
            $this->db->trans_begin();

            if (!empty($product)){
                $this->productmodel->update('product', $where, $product);
            }

            if($this->db->trans_status() === FALSE){
                throw new Exception('Problemas con la transacción. Por favor, vuelva a intentar!');
            }
            else{
                $this->db->trans_commit();
                echo $id;
            }
        } catch (Exception $e){
            $this->db->trans_rollback();
            echo $e->getMessage();
        }
    }
}
?>