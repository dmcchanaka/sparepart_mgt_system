<?php

class dataFunctions {

    public static function CheckUser($uname, $pwd, $mycon) {
        $user_info = array();
        $u_name = mysqli_real_escape_string($mycon, $uname);
        $query = "SELECT 
            u.u_id,
            u.u_name,
            ut.user_type 
        FROM 
        tbl_user u 
            INNER JOIN 
        tbl_user_type ut ON u.u_tp_id = ut.u_tp_id 
        WHERE 
            u.u_status = '0' 
            AND u.username = '$u_name' 
            AND u.password = '" . md5($pwd) . "'";
        $result = mysqli_query($mycon, $query);
        $row = mysqli_fetch_assoc($result);

        $user_info['u_id'] = $row['u_id'];
        $user_info['u_name'] = $row['u_name'];
        $user_info['u_type'] = $row['user_type'];
        return $user_info;
    }

    public static function suppliers($mycon) {
        $query = "SELECT sup_id, sup_name FROM tbl_supplier WHERE sup_status='0' ORDER BY sup_name";
        $result = mysqli_query($mycon, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <option value="<?php echo $row['sup_id']; ?>"><?php echo $row['sup_name']; ?></option>   
        <?php
        }
    }
    public static function products($mycon) {
        $query = "SELECT product_id, product_name FROM tbl_product WHERE product_status='0' ORDER BY product_name";
        $result = mysqli_query($mycon, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <option value="<?php echo $row['product_id']; ?>"><?php echo $row['product_name']; ?></option>   
        <?php
        }
    }
    public static function brands($mycon){
        $query = "SELECT brand_id, brand_name FROM tbl_brand WHERE brand_status='0' ORDER BY brand_name";
        $result = mysqli_query($mycon, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <option value="<?php echo $row['brand_id']; ?>"><?php echo $row['brand_name']; ?></option>   
        <?php
        }
    }

    public static function edit_supplier($mycon,$sup_id){
        $query = "SELECT sup_id, sup_name FROM tbl_supplier WHERE sup_status='0' ORDER BY sup_name";
        $result = mysqli_query($mycon, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <option value="<?php echo $row['sup_id']; ?>" <?php if($sup_id ==$row['sup_id']){ echo 'selected'; } ?>><?php echo $row['sup_name']; ?></option>   
        <?php
        }
    }
    public static function edit_product($mycon,$pro_id){
        $query = "SELECT product_id, product_name FROM tbl_product WHERE product_status='0' ORDER BY product_name";
        $result = mysqli_query($mycon, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <option value="<?php echo $row['product_id']; ?>" <?php if($pro_id ==$row['product_id']){ echo 'selected'; } ?>><?php echo $row['product_name']; ?></option>   
        <?php
        }
    }
    public static function edit_brand($mycon,$brand_id){
        $query = "SELECT brand_id, brand_name FROM tbl_brand WHERE brand_status='0' ORDER BY brand_name";
        $result = mysqli_query($mycon, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <option value="<?php echo $row['brand_id']; ?>" <?php if($brand_id ==$row['brand_id']){ echo 'selected'; } ?>><?php echo $row['brand_name']; ?></option>   
        <?php
        }
    }
    public static function edit_price($mycon,$price_id){
        $query = "SELECT price_id, dealer_price FROM tbl_price WHERE price_status = '0' ORDER BY price_id";
        $result = mysqli_query($mycon, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <option value="<?php echo $row['price_id']; ?>" <?php if($price_id ==$row['price_id']){ echo 'selected'; } ?>><?php echo $row['dealer_price']; ?></option>   
        <?php
        }
    }
}
