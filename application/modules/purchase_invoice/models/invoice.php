<?php
class Invoice extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('purchase_invoice.*,direct_grn.grn_no,purchase_invoice.invoice,purchase_invoice.guid as invoice_guid, purchase_invoice.date as date,suppliers.first_name as s_name,suppliers.company_name as c_name');
                $this->db->from('purchase_invoice')->where('purchase_invoice.branch_id',$branch);
                $this->db->join('direct_grn', 'direct_grn.guid=purchase_invoice.grn','left');
                $this->db->join('direct_invoice', 'direct_invoice.guid=purchase_invoice.direct_invoice_id','left');
                $this->db->join('purchase_order', 'purchase_order.guid=purchase_invoice.po','left');
                $this->db->join('suppliers', 'suppliers.guid=purchase_order.supplier_id OR suppliers.guid=direct_grn.supplier_id OR suppliers.guid=direct_invoice.supplier_id','left');
                $this->db->limit($end,$start); 
                $this->db->or_like($like);     
                $query=$this->db->get();
                $data=array();
                foreach ($query->result_array() as $row){
                 
                    $row['date']=date('d-m-Y',$row['date']);
                    $data[]=$row;
                   
                }
//              
                
            return $data;
        
    }
    function search_grn_order($like,$branch){
        $this->db->select('direct_grn.*,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name');
        $this->db->from('direct_grn')->where('direct_grn.branch_id',$branch)->where('direct_grn.invoice_status',0)->where('direct_grn.order_status',1)->where('direct_grn.active_status',1)->where('direct_grn.delete_status',0);
        $or_like=array('grn_no'=>$like,'suppliers.company_name'=>$like,'suppliers.first_name'=>$like);
        $this->db->join('suppliers', 'suppliers.guid=direct_grn.supplier_id AND direct_grn.invoice_status=0 ','left');

        $this->db->or_like($or_like);     
        $this->db->limit($this->session->userdata['data_limit']);
        $sql=$this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){
            $row['grn_date']=date('d-m-Y',$row['grn_date']);
          
             $data[]=$row;

        }
        
        // get data from grn
        
        $this->db->select('grn.invoice_status,grn.guid,grn.grn_no,grn.date as grn_date ,grn.po,purchase_order.supplier_id,suppliers.guid as s_guid');
        $this->db->from('grn')->where('grn.branch_id',$branch)->where('grn.grn_status',1)->where('grn.invoice_status',0)->where('grn.delete_status',0);
        $or_like=array('grn_no'=>$like,'suppliers.company_name'=>$like,'suppliers.first_name'=>$like);
        $this->db->join('purchase_order', 'purchase_order.guid=grn.po AND grn.invoice_status=0 ','left');
        $this->db->join('suppliers', 'suppliers.guid=purchase_order.supplier_id ','left');
        $this->db->or_like($or_like);     
        $sql=$this->db->get();
       
        foreach($sql->result_array() as $row){
            $row['grn_date']=date('d-m-Y',$row['grn_date']);
            $data[]=$row;
        }
         return $data;
               
      


    }
   
  
  
   
    
    function count($branch){
        $this->db->select()->from('purchase_invoice')->where('branch_id',$branch);
        $sql=  $this->db->get();
        return $sql->num_rows();
    }
    
   
      function get_direct_grn($guid){
         $this->db->select('items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,suppliers_x_items.quty as item_limit,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name,suppliers.address1 as address,direct_grn.*,purchase_items.discount_per as dis_per ,purchase_items.discount_amount as item_dis_amt ,purchase_items.tax as dis_amt ,purchase_items.tax as order_tax,purchase_items.item ,purchase_items.quty ,purchase_items.free ,purchase_items.cost ,purchase_items.sell ,purchase_items.mrp,purchase_items.guid as o_i_guid ,purchase_items.amount ,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('direct_grn')->where('direct_grn.guid',$guid);
         $this->db->join('purchase_items', 'purchase_items.order_id = direct_grn.guid ','left');
         $this->db->join('items', "items.guid=purchase_items.item AND purchase_items.order_id='".$guid."' ",'left');
         $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=purchase_items.item  ",'left');
         $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=purchase_items.item  ",'left');
         $this->db->join('suppliers', "suppliers.guid=direct_grn.supplier_id AND purchase_items.order_id='".$guid."' ",'left');
         $this->db->join('suppliers_x_items', "suppliers_x_items.supplier_id=direct_grn.supplier_id AND suppliers_x_items.item_id=purchase_items.item AND purchase_items.order_id='".$guid."'  ",'left');
         $sql=  $this->db->get();
         $data=array();
         foreach($sql->result_array() as $row){
             
          $row['grn_date']=date('d-m-Y',$row['grn_date']);
       
      
         
          $data[]=$row;
         }
         return $data;
    }
    function get_goods_receiving_note($guid){
        $this->db->select('purchase_items.discount_per2 as dis_per2,items.tax_inclusive2,items.tax2_type,items.tax2_value,items.tax_Inclusive ,grn.date as grn_date,grn.note as grn_note,grn.remark as grn_remark,grn.grn_no,items.tax_Inclusive ,grn.po,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,suppliers_x_items.quty as item_limit,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name,suppliers.address1 as address,purchase_order.*,purchase_items.discount_per as dis_per ,purchase_items.discount_amount as item_dis_amt ,purchase_items.tax as dis_amt ,purchase_items.tax as order_tax,purchase_items.item ,purchase_items.quty ,purchase_items.free,purchase_items.guid as o_i_guid ,purchase_items.received_quty ,purchase_items.received_free ,purchase_items.cost ,purchase_items.sell ,purchase_items.mrp,purchase_items.guid as o_i_guid ,purchase_items.amount ,purchase_items.date,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('grn')->where('grn.guid',$guid);
        $this->db->join('purchase_order', 'grn.po=purchase_order.guid','left');
        $this->db->join('purchase_items', 'purchase_items.order_id = purchase_order.guid AND grn.guid=purchase_items.grn_id AND purchase_items.delete_status=0','left');
        $this->db->join('items', "items.guid=purchase_items.item AND grn.guid=purchase_items.grn_id AND purchase_items.order_id=purchase_order.guid AND purchase_items.delete_status=0",'left');
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=purchase_items.item  AND purchase_items.delete_status=0",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=purchase_items.item  AND purchase_items.delete_status=0",'left');
        $this->db->join('suppliers', "suppliers.guid=purchase_order.supplier_id AND purchase_items.order_id=purchase_order.guid  AND purchase_items.delete_status=0",'left');
        $this->db->join('suppliers_x_items', "suppliers_x_items.supplier_id=purchase_order.supplier_id AND suppliers_x_items.item_id=purchase_items.item AND purchase_items.order_id='".$guid."'  AND purchase_items.delete_status=0",'left');
        $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){             
            $row['po_date']=date('d-m-Y',$row['po_date']);       
            $row['grn_date']=date('d-m-Y',$row['grn_date']);       
            $row['exp_date']=date('d-m-Y',$row['exp_date']);         
            $row['date']=date('d-m-Y',$row['date']); 
           
            $data[]=$row;
        }
        return $data;
    }
    function direct_grn_invoice_status($grn,$guid){
        $this->db->where('guid',$grn);
        $this->db->update('direct_grn',array('invoice_status'=>1));
        $this->db->where(array('order_id'=>$grn,'branch_id'=>  $this->session->userdata('branch_id')));
        $this->db->update('purchase_items',array('invoice_id'=>$guid,'time'=>strtotime(date('H:i:s'))));
    }
    function grn_invoice_status($grn,$guid){
        $this->db->where('guid',$grn);
        $this->db->update('grn',array('invoice_status'=>1));
        $this->db->where(array('grn_id'=>$grn,'branch_id'=>  $this->session->userdata('branch_id')));
        $this->db->update('purchase_items',array('invoice_id'=>$guid,'time'=>strtotime(date('H:i:s'))));
    }
    /*
     * supplier payable amount   from Direct Grn  */
    // function start
    function direct_grn_payable_amount($grn,$invoice){
        $this->db->select('total_amt,supplier_id')->from('direct_grn')->where('guid',$grn);
        $sql=  $this->db->get();
        $amount;
        $supplier;
        foreach ($sql->result() as $row){
            $amount=$row->total_amt;
            $supplier=$row->supplier_id;
        }
        $this->db->insert('supplier_payable',array('supplier_id'=>$supplier,'invoice_id'=>$invoice,'amount'=>$amount,'branch_id'=>  $this->session->userdata['branch_id']));
        $id=  $this->db->insert_id();
        $this->db->where('id',$id);
        $this->db->update('supplier_payable',array('guid'=>  md5($supplier.$invoice.$id)));
    }
    // function end
    
    /*
     * supplier payable amount   from  Grn  */
    function grn_payable_amount($grn,$invoice,$po){
        $this->db->select('purchase_items.tax,items.tax_Inclusive, purchase_items.discount_per,purchase_items.discount_amount,purchase_items.received_quty,purchase_items.cost,purchase_order.*')->from('grn')->where('grn.guid',$grn);
        $this->db->join('purchase_order',"purchase_order.guid=grn.po AND purchase_order.guid='".$po."'",'left');
        $this->db->join('purchase_items', 'purchase_items.order_id = purchase_order.guid AND grn.guid=purchase_items.grn_id ','left');
        $this->db->join('items', "items.guid=purchase_items.item AND grn.guid=purchase_items.grn_id AND purchase_items.order_id=purchase_order.guid ",'left');
        
        
        $sql=  $this->db->get();
        $freight=0;
        $round_amt=0;
        $discount=0;
        $discount_amt=0;
        $round_amt=0;
        $supplier;
        $amount=0;
        foreach ($sql->result() as $row){
            $item_amount=0;
            $discount_per=0;
            $discount_amount=0;
            $discount_per=$row->discount_per;
            $discount_amount=$row->discount_amount;
            $item_amount=($row->cost*$row->received_quty);
           
                if($discount_per!='' && $discount_per!=0){
                   
                    $current=($item_amount*$discount_per)/100;
                   $item_amount=$item_amount-$current;
                }else{
                  $item_amount=$item_amount-$discount_amount;
                }
                
            if($row->tax_Inclusive==1){
             $item_amount=$item_amount+$row->tax;
            }
                
           $amount=$amount+$item_amount;
          
           
            $freight=$row->freight;
            $round_amt=$row->round_amt;
            $discount=$row->discount;
            $discount_amt=$row->discount_amt;
            $round_amt=$row->round_amt;
            $supplier=$row->supplier_id;
        }
        
  
        if($discount=="" or $discount=='0'){
        
         $amount=$amount-$discount_amt;
        }else{
           $current=($amount*$discount)/100;
            $amount=$amount-$current;
        }
        $amount=$freight+$round_amt+$amount;
       $discount;
        $this->db->insert('supplier_payable',array('supplier_id'=>$supplier,'invoice_id'=>$invoice,'amount'=>$amount,'branch_id'=>  $this->session->userdata['branch_id']));
        $id=  $this->db->insert_id();
        $this->db->where('id',$id);
        $this->db->update('supplier_payable',array('guid'=>  md5($supplier.$invoice.$id)));
    }
    function check_duplicate($where){
        $this->db->select()->from('purchase_invoice')->where($where)->where('branch_id',  $this->session->userdata['branch_id']);
        $sql=  $this->db->get();
        if($sql->num_rows()>0){
            return FALSE;
        }  else {
            return TRUE;    
        }
    }
    function view_purchase_invoice($guid){
        $this->db->select('grn.guid as grn_guid,direct_invoice.guid as direct_invoice_guid,direct_invoice.discount_amt as direct_invoice_discount_amt,direct_invoice.discount as direct_invoice_discount,direct_invoice.freight as direct_invoice_freight,direct_invoice.round_amt as direct_invoice_round_amt,direct_invoice.total_amt as direct_invoice_total_amt,direct_invoice.total_item_amt as direct_invoice_total_item_amt,purchase_order.freight as grn_freight,purchase_order.round_amt as grn_round_amt ,purchase_order.discount as grn_discount,purchase_order.discount_amt as grn_discount_amt,grn.total_item_amt as grn_total_item_amt,grn.total_amt as grn_total_amt,direct_grn.guid as direct_grn_guid,direct_grn.discount as direct_grn_discount,direct_grn.discount_amt as direct_grn_discount_amt,direct_grn.freight as direct_grn_freight,direct_grn.round_amt as direct_grn_round_amt,direct_grn.total_amt as direct_grn_total_amt,direct_grn.total_item_amt as direct_grn_total_item_amt, direct_grn.grn_no as direct_grn_no,grn.grn_no,direct_grn.grn_date as direct_grn_date,direct_invoice.invoice_date as direct_invoice_date,grn.date as received_date,purchase_order.po_date,branches.code as branch_code,branches.store_name as branch_name,branches.address as branch_address,branches.city as branch_city,branches.state as branch_state,branches.zip as branch_zip ,branches.country as branch_country,branches.phone as branch_phone,branches.email as branch_mail,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name,suppliers.address1 as address,suppliers.email as supplier_email,suppliers.phone as supplier_phone,suppliers.city as supplier_city,suppliers.state as supplier_state,suppliers.zip as supplier_zip,suppliers.country as supplier_country,purchase_items.discount_per as dis_per ,purchase_items.discount_amount as item_dis_amt ,purchase_items.discount_amount2 as item_dis_amt2 ,purchase_items.tax2 as order_tax2 ,purchase_items.tax as order_tax,purchase_items.item ,purchase_items.quty ,purchase_items.free ,purchase_items.cost ,purchase_items.sell ,purchase_items.mrp,purchase_items.guid as o_i_guid ,purchase_items.amount ,purchase_items.date,items.guid as i_guid,items.name as items_name,items.code as i_code, items.tax_inclusive2,items.tax2_type,items.tax2_value,purchase_invoice.*,purchase_items.received_quty ,purchase_items.received_free ,purchase_items.discount_per2 as dis_per2');
        $this->db->from('purchase_invoice')->where('purchase_invoice.guid',$guid);
        $this->db->join('branches', "branches.guid = purchase_invoice.branch_id ",'left');
        $this->db->join('direct_grn', 'direct_grn.guid=purchase_invoice.grn','left');
        $this->db->join('direct_invoice', 'direct_invoice.guid=purchase_invoice.direct_invoice_id','left');
        $this->db->join('purchase_order', 'purchase_order.guid=purchase_invoice.po','left');
        $this->db->join('grn', 'grn.guid=purchase_invoice.grn','left');
        $this->db->join('purchase_items', 'purchase_items.invoice_id = purchase_invoice.guid ','left');
        $this->db->join('items', 'items.guid=purchase_items.item','left');
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=purchase_items.item  AND purchase_items.delete_status=0",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=purchase_items.item  AND purchase_items.delete_status=0",'left');
        $this->db->join('suppliers', 'suppliers.guid=purchase_invoice.supplier_id','left');
         
        $query=$this->db->get();
        $data=array();
        foreach ($query->result_array() as $row){
            if($row['received_quty']!=0 && $row['received_quty']!=""){
                $row['quty']=$row['received_quty'];
            }
            if($row['received_free']!=0 && $row['received_free']!=""){
                $row['free']=$row['received_free'];
            }
            $row['date']=date('d-m-Y',$row['date']);
            $row['received_date']=date('d-m-Y',$row['received_date']);
            $row['po_date']=date('d-m-Y',$row['po_date']);
            $row['direct_invoice_date']=date('d-m-Y',$row['direct_invoice_date']);
            $row['direct_grn_date']=date('d-m-Y',$row['direct_grn_date']);
            
            if($row['direct_invoice_date']!="" && $row['direct_invoice_date']!=0){
                $row['received_date']=$row['received_date'];
                $row['po_date']=$row['po_date'];
            }
            if($row['direct_grn_date']!="" && $row['direct_grn_date']!=0){
                $row['received_date']=$row['direct_grn_date'];
                $row['po_date']=$row['direct_grn_date'];
            }
            $row['grn_no']=$row['grn_no'];
            if($row['direct_grn_no']!="" && $row['direct_grn_no']!=0){
                $row['grn_no']=$row['direct_grn_no'];
            }
            
            if($row['direct_invoice_guid']!="" && $row['direct_invoice_guid']!=0){
                $row['discount']=$row['direct_invoice_discount'];
                $row['discount_amt']=$row['direct_invoice_discount_amt'];
                $row['freight']=$row['direct_invoice_freight'];
                $row['round_amt']=$row['direct_invoice_round_amt'];
                $row['total_item_amt']=$row['direct_invoice_total_item_amt'];
                $row['total_amt']=$row['direct_invoice_total_amt'];
            }
            if($row['direct_grn_guid']!="" && $row['direct_grn_guid']!=0){
                $row['discount']=$row['direct_grn_discount'];
                $row['discount_amt']=$row['direct_grn_discount_amt'];
                $row['freight']=$row['direct_grn_freight'];
                $row['round_amt']=$row['direct_grn_round_amt'];
                $row['total_item_amt']=$row['direct_grn_total_item_amt'];
                $row['total_amt']=$row['direct_grn_total_amt'];
            }
            if($row['grn_guid']!=""){
                $row['discount']=$row['grn_discount'];
                $row['discount_amt']=$row['grn_discount_amt'];
                $row['freight']=$row['grn_freight'];
                $row['round_amt']=$row['grn_round_amt'];
                $row['total_item_amt']=$row['grn_total_item_amt'];
                $row['total_amt']=$row['grn_total_amt'];               
            }
                $data[]=$row;
            }
        return $data;
    }
    function purchase_invoice_invoice($guid){
        $this->db->select('grn.guid as grn_guid,direct_invoice.guid as direct_invoice_guid,direct_invoice.discount_amt as direct_invoice_discount_amt,direct_invoice.discount as direct_invoice_discount,direct_invoice.freight as direct_invoice_freight,direct_invoice.round_amt as direct_invoice_round_amt,direct_invoice.total_amt as direct_invoice_total_amt,direct_invoice.total_item_amt as direct_invoice_total_item_amt,purchase_order.freight as grn_freight,purchase_order.round_amt as grn_round_amt ,purchase_order.discount as grn_discount,purchase_order.discount_amt as grn_discount_amt,grn.total_item_amt as grn_total_item_amt,grn.total_amt as grn_total_amt,direct_grn.guid as direct_grn_guid,direct_grn.discount as direct_grn_discount,direct_grn.discount_amt as direct_grn_discount_amt,direct_grn.freight as direct_grn_freight,direct_grn.round_amt as direct_grn_round_amt,direct_grn.total_amt as direct_grn_total_amt,direct_grn.total_item_amt as direct_grn_total_item_amt, direct_grn.grn_no as direct_grn_no,grn.grn_no,direct_grn.grn_date as direct_grn_date,direct_invoice.invoice_date as direct_invoice_date,grn.date as received_date,purchase_order.po_date,branches.code as branch_code,branches.store_name as branch_name,branches.address as branch_address,branches.city as branch_city,branches.state as branch_state,branches.zip as branch_zip ,branches.country as branch_country,branches.phone as branch_phone,branches.email as branch_mail,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name,suppliers.address1 as address,suppliers.email as supplier_email,suppliers.phone as supplier_phone,suppliers.city as supplier_city,suppliers.state as supplier_state,suppliers.zip as supplier_zip,suppliers.country as supplier_country,purchase_items.discount_per as dis_per ,purchase_items.discount_amount as item_dis_amt ,purchase_items.discount_amount2 as item_dis_amt2 ,purchase_items.tax2 as order_tax2 ,purchase_items.tax as order_tax,purchase_items.item ,purchase_items.quty ,purchase_items.free ,purchase_items.cost ,purchase_items.sell ,purchase_items.mrp,purchase_items.guid as o_i_guid ,purchase_items.amount ,purchase_items.date,items.guid as i_guid,items.name as items_name,items.code as i_code, items.tax_inclusive2,items.tax2_type,items.tax2_value,purchase_invoice.*,purchase_items.received_quty ,purchase_items.received_free ,purchase_items.discount_per2 as dis_per2');
        $this->db->from('purchase_invoice')->where('purchase_invoice.guid',$guid);
        $this->db->join('branches', "branches.guid = purchase_invoice.branch_id ",'left');
        $this->db->join('direct_grn', 'direct_grn.guid=purchase_invoice.grn','left');
        $this->db->join('direct_invoice', 'direct_invoice.guid=purchase_invoice.direct_invoice_id','left');
        $this->db->join('purchase_order', 'purchase_order.guid=purchase_invoice.po','left');
        $this->db->join('grn', 'grn.guid=purchase_invoice.grn','left');
        $this->db->join('purchase_items', 'purchase_items.invoice_id = purchase_invoice.guid ','left');
        $this->db->join('items', 'items.guid=purchase_items.item','left');
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=purchase_items.item  AND purchase_items.delete_status=0",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=purchase_items.item  AND purchase_items.delete_status=0",'left');
        $this->db->join('suppliers', 'suppliers.guid=purchase_invoice.supplier_id','left');
         
        $query=$this->db->get();
        $data=array();
        foreach ($query->result_array() as $row){
            if($row['received_quty']!=0 && $row['received_quty']!=""){
                $row['quty']=$row['received_quty'];
            }
            if($row['received_free']!=0 && $row['received_free']!=""){
                $row['free']=$row['received_free'];
            }
            $row['date']=date('d-m-Y',$row['date']);
            $row['received_date']=date('d-m-Y',$row['received_date']);
            $row['po_date']=date('d-m-Y',$row['po_date']);
            $row['direct_invoice_date']=date('d-m-Y',$row['direct_invoice_date']);
            $row['direct_grn_date']=date('d-m-Y',$row['direct_grn_date']);
            
            if($row['direct_invoice_date']!="" && $row['direct_invoice_date']!=0){
                $row['received_date']=$row['received_date'];
                $row['po_date']=$row['po_date'];
            }
            if($row['direct_grn_date']!="" && $row['direct_grn_date']!=0){
                $row['received_date']=$row['direct_grn_date'];
                $row['po_date']=$row['direct_grn_date'];
            }
            $row['grn_no']=$row['grn_no'];
            if($row['direct_grn_no']!="" && $row['direct_grn_no']!=0){
                $row['grn_no']=$row['direct_grn_no'];
            }
            
            if($row['direct_invoice_guid']!="" && $row['direct_invoice_guid']!=0){
                $row['discount']=$row['direct_invoice_discount'];
                $row['discount_amt']=$row['direct_invoice_discount_amt'];
                $row['freight']=$row['direct_invoice_freight'];
                $row['round_amt']=$row['direct_invoice_round_amt'];
                $row['total_item_amt']=$row['direct_invoice_total_item_amt'];
                $row['total_amt']=$row['direct_invoice_total_amt'];
            }
            if($row['direct_grn_guid']!="" && $row['direct_grn_guid']!=0){
                $row['discount']=$row['direct_grn_discount'];
                $row['discount_amt']=$row['direct_grn_discount_amt'];
                $row['freight']=$row['direct_grn_freight'];
                $row['round_amt']=$row['direct_grn_round_amt'];
                $row['total_item_amt']=$row['direct_grn_total_item_amt'];
                $row['total_amt']=$row['direct_grn_total_amt'];
            }
            if($row['grn_guid']!=""){
                $row['discount']=$row['grn_discount'];
                $row['discount_amt']=$row['grn_discount_amt'];
                $row['freight']=$row['grn_freight'];
                $row['round_amt']=$row['grn_round_amt'];
                $row['total_item_amt']=$row['grn_total_item_amt'];
                $row['total_amt']=$row['grn_total_amt'];               
            }
                $data[]=$row;
            }
        return $data;
    }
    
}
   
?>
