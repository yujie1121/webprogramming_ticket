<?php
/*
######################################################################
# __      __          __         ___                                 #
#/\ \  __/\ \        /\ \      /'___\                                #
#\ \ \/\ \ \ \     __\ \ \____/\ \__/  ___   _ __   ___     __       #
# \ \ \ \ \ \ \  /'__`\ \ '__`\ \ ,__\/ __`\/\`'__\/'___\ /'__`\     #
#  \ \ \_/ \_\ \/\  __/\ \ \L\ \ \ \_/\ \L\ \ \ \//\ \__//\  __/     #
#   \ `\___x___/\ \____\\ \_,__/\ \_\\ \____/\ \_\\ \____\ \____\    #
#    '\/__//__/  \/____/ \/___/  \/_/ \/___/  \/_/ \/____/\/____/    #
#                                                                    #
#     )   ___                                                        #
#    (__/_____)                      Webforce Cart v.1.5             #
#      /       _   __ _/_            (c) 2004-2005 Webforce Ltd, NZ  #
#     /       (_(_/ (_(__            webforce.co.nz/cart             #
#    (______)                        all rights reserved             #
#                                                                    #
#  Session based, Object Oriented Shopping Cart Component for PHP    #
#                                                                    #
######################################################################
# Ver 1.6 - Bugfix // Thanks James
# Ver 1.5 - Demo updated, Licence changed to LGPL
# Ver 1.4 - demo included
# Ver 1.3 - bugfix with total 
# Ver 1.2 - added empty_cart()
# Ver 1.0 - initial release
You are allowed to use this script in websites you create. 
Licence: LGPL - http://www.gnu.org/copyleft/lesser.txt
*** Instructions at http://www.webforce.co.nz/cart/php-cart.php ***
*** READ THEM!                                                 ***

BUGS/PATCHES

Please email eaden@webforce.co.nz with any bugs/fixes/patches/comments etc.
See http://www.webforce.co.nz/cart/ for updates to this script

*/
class wfCart {
	var $total = 0;
	var $itemcount = 0;
	var $items = array();
    var $itemprice = array();
	var $itemqtys = array();
	var $itemname = array();//原本是info
    var $itemtype = array();//多加的
    var $itemstart = array();
    var $itemend = array();
    var $itemplace = array();
    
	function cart() {} // constructor function

	function get_contents()
	{ // 獲取 cart 商品
		$items = array();
		foreach($this->items as $tmp_item)
		{
		        $item = FALSE;

			$item['id'] = $tmp_item;
            $item['quantity'] = $this->itemqtys[$tmp_item];
			$item['price'] = $this->itemprice[$tmp_item];
			$item['name'] = $this->itemname[$tmp_item];
			$item['type'] = $this->itemtype[$tmp_item];
			$item['start'] = $this->itemstart[$tmp_item];
			$item['end'] = $this->itemend[$tmp_item];
			$item['place'] = $this->itemplace[$tmp_item];
			$item['subtotal'] = (int)($item['quantity'] * $item['price']);
            $items[] = $item;
		}
		return $items;
	} // 結束獲取cart商品


	function add_item($id,$quantity=1,$price=FALSE,$name=FALSE,$type=FALSE,$start=FALSE,$end=FALSE,$place=FALSE)
	{ // adds an item to cart 加入商品
                if(!$id)
		{
		        $id = wf_get_id($id);
		}
                if(!$price)
		{
		        $price = wf_get_price($id,$quantity);
		}
                if(!$name)
		{
                $name = wf_get_name($id);
		}
                if(!$type)
		{
                $type = wf_get_type($id);
		}
		        if(!$start)
		{
                $start = wf_get_start($id);
		}
		        if(!$end)
		{
                $end = wf_get_end($id);
		}
		        if(!$place)
		{
                $place = wf_get_place($id);
		}
		if($this->itemqtys[$id] =false){// the item is already in the cart.just increase the quantity
			$this->itemqtys[$id] = $quantity + $this->itemqtys[$id];
			$this->_update_total();
		} else {
			$this->items[]=$id;
			$this->itemqtys[$id] = $quantity;
			$this->itemprice[$id] = $price;
			$this->itemname[$id] = $name;
			$this->itemtype[$id] = $type;
			$this->itemstart[$id] = $start;
			$this->itemend[$id] = $end;
			$this->itemplace[$id] = $place;
		}
		$this->_update_total();
	} // end of add_item 結束


	function edit_item($id,$quantity)
	{ // changes an items quantity 更改物品數量

		if($qty < 1) {
			$this->del_item($id);
		} else {
			$this->itemqtys[$id] = $quantity;
			// uncomment this line if using 
			// the wf_get_price function
			// $this->itemprices[$itemid] = wf_get_price($itemid,$qty);
		}
		$this->_update_total();
	} // end of edit_item 結束


	function del_item($id)
	{ // removes an item from cart 刪除商品
		$ti = array();
		$this->itemqtys[$id] = 0;
		foreach($this->items as $item)
		{
			if($item != $id)
			{
				$ti[] = $item;
			}
		}
		$this->items = $ti;
		$this->_update_total();
	} //end of del_item 結束


    function empty_cart()
	{ // empties / resets the cart
            $this->total = 0;
	        $this->itemcount = 0;
	        $this->items = array();
            $this->itemprices = array();
	        $this->itemqtys = array();
            $this->itemname = array();
            $this->itemtype = array();
            $this->$itemstart = array();
            $this->$itemend = array();
            $this->$itemplace = array();
	} // end of empty cart 結束


	function _update_total()
	{ // internal function to update the total in the cart
	    $this->itemcount = 0;
		$this->total = 0;
                if(sizeof($this->items) > 0)
		{
                        foreach($this->items as $item) {
                                $this->total = (int)$this->total + (int)($this->itemprice[$item]*$this->itemqtys[$item]);
				$this->itemcount++;
			}
		}
	} // end of update_total

}
?>
