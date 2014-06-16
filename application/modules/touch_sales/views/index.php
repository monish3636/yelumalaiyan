<style type="text/css">
    
    .header{
        background: #405b75;
        overflow-x: hidden;
        overflow-y: hidden;
    }
    .item_right{
        background: #e3eaf3;
        height: 435px; 
      //  border: solid 3px #003333;
        white-space: nowrap;
         overflow-x: hidden;
        overflow-y: hidden;
    }
    .item{
        height: 80px;
        margin-bottom: 2px;
        white-space: normal;
        width: 19.5322%;
        background: #99417b;
        color: #ffffff;
        border: solid 2px #99417b;
        border-radius: 10px;
    }
    .item a{
        color: #ffffff;
    }
    .header-bar{
        margin-top: 5px;
    }
    .row + .row {
        margin-top:4px;
    }
    .item strong{
        color: black;
        font-size: 15px;
    }
    .randomStuff{
        background-color:red;
        border: 3px solid green;
        position:absolute;
        width:100px;
        height:100px;
    }
    .item-nav{
        background: #e3eaf3;
    }
    .numbers{
        border-radius: 8px;
        font-size: 16px;
        margin-bottom: 1px;
        margin-left: 1px;
        margin-right: 1px;
        margin-top: 1px;
        padding: 12px;
        width: 32%;
    }
    .numbers hover{
        background: #e3eaf3 !important;
    }
    .search-input{
        height: 44px;
        font-size: 18px;
    }
    .item-list{
        background: #e3eaf3;
        overflow: auto;
        height: 548px;
        overflow-x: hidden;
        
    }
    .item-list h5{
        font-weight: bold;
    }
    .item-amount{
        background: #e3eaf3;
        
    }
    .quantty{
        width: 30px;
    }
</style>
<body class="header">
    <div id="container " >
        
      
        <div class="row header-bar">
            <div class="col col-lg-1 ">
            </div>
            <div class="col col-lg-4 ">
                <div class="row" style="margin: 33px 10px 10px -10px;">
                    <div class="input-group search-input" >
                        <span class="input-group-addon" style="width:  43px"><i class="icon icon-user icon-2x"></i></span>
                        <input id="appendedInputButton" class="form-control search-input" type="text">
                        <span class="input-group-btn">
                            <button class="btn btn-default " style="height: 44px" type="button"><i class="icon icon-search icon-2x"></i></button>
                        </span>
                    </div>
                </div>
                <div class="row" style="margin: 10px 10px 10px -10px;">
                    <div class="input-group search-input" >
                        <span class="input-group-addon" style="width:  43px"><i class="icon icon-shopping-cart icon-2x"></i></span>
                        <input id="appendedInputButton" class="form-control search-input" type="text">
                        <span class="input-group-btn">
                            <button class="btn btn-default " style="height: 44px" type="button"><i class="icon icon-search icon-2x"></i></button>
                        </span>
                    </div>
                </div>
                <div class="row item-list" style="margin-right: 10px;margin-left:-10px;padding: 10px">
                    <div class="row">
                        <div class="col col-lg-1"><h5><?php echo $this->lang->line('no') ?></h5></div>
                        <div class="col col-lg-4"><h5><?php echo $this->lang->line('item') ?></h5></div>
                        <div class="col col-lg-3"><h5><?php echo $this->lang->line('price') ?></h5></div>
                        <div class="col col-lg-3"><h5><?php echo $this->lang->line('qty') ?></h5></div>
                        <div class="col col-lg-1"></div>
                    </div>
                    <div class="row">
                        <div class="col col-lg-1">1</div>
                        <div class="col col-lg-4">item 1</div>
                        <div class="col col-lg-2">59.56</div>
                        <div class="col col-lg-3"><input type="text" class="form-control"></div>
                        <div class="col col-lg-2"><a href="" class="btn btn-danger"><i class="icon icon-trash"></i></a></div>
                    </div>
                    <div class="row">
                        <div class="col col-lg-1">2</div>
                        <div class="col col-lg-4">item 1</div>
                        <div class="col col-lg-2">59.56</div>
                        <div class="col col-lg-3"><input type="text" class="form-control"></div>
                        <div class="col col-lg-2"><a href="" class="btn btn-danger"><i class="icon icon-trash"></i></a></div>
                    </div>
                    <div class="row">
                        <div class="col col-lg-1">3</div>
                        <div class="col col-lg-4">item 1</div>
                        <div class="col col-lg-2">59.56</div>
                        <div class="col col-lg-3"><input type="text" class="form-control"></div>
                        <div class="col col-lg-2"><a href="" class="btn btn-danger"><i class="icon icon-trash"></i></a></div>
                    </div>
                    <div class="row">
                        <div class="col col-lg-1">4</div>
                        <div class="col col-lg-4">item 1</div>
                        <div class="col col-lg-2">59.56</div>
                        <div class="col col-lg-3"><input type="text" class="form-control"></div>
                        <div class="col col-lg-2"><a href="" class="btn btn-danger"><i class="icon icon-trash"></i></a></div>
                    </div>
                    <div class="row">
                        <div class="col col-lg-1">5</div>
                        <div class="col col-lg-4">item 1</div>
                        <div class="col col-lg-2">59.56</div>
                        <div class="col col-lg-3"><input type="text" class="form-control"></div>
                        <div class="col col-lg-2"><a href="" class="btn btn-danger"><i class="icon icon-trash"></i></a></div>
                    </div>
                    <div class="row">
                        <div class="col col-lg-1">6</div>
                        <div class="col col-lg-4">item 1</div>
                        <div class="col col-lg-2">59.56</div>
                        <div class="col col-lg-3"><input type="text" class="form-control"></div>
                        <div class="col col-lg-2"><a href="" class="btn btn-danger"><i class="icon icon-trash"></i></a></div>
                    </div>
                    <div class="row">
                        <div class="col col-lg-1">7</div>
                        <div class="col col-lg-4">item 1</div>
                        <div class="col col-lg-2">59.56</div>
                        <div class="col col-lg-3"><input type="text" class="form-control"></div>
                        <div class="col col-lg-2"><a href="" class="btn btn-danger"><i class="icon icon-trash"></i></a></div>
                    </div>
                    <div class="row">
                        <div class="col col-lg-1">8</div>
                        <div class="col col-lg-4">item 1</div>
                        <div class="col col-lg-2">59.56</div>
                        <div class="col col-lg-3"><input type="text" class="form-control"></div>
                        <div class="col col-lg-2"><a href="" class="btn btn-danger"><i class="icon icon-trash"></i></a></div>
                    </div>
                    <div class="row">
                        <div class="col col-lg-1">9</div>
                        <div class="col col-lg-4">item 1</div>
                        <div class="col col-lg-2">59.56</div>
                        <div class="col col-lg-3"><input type="text" class="form-control"></div>
                        <div class="col col-lg-2"><a href="" class="btn btn-danger"><i class="icon icon-trash"></i></a></div>
                    </div>
                    <div class="row">
                        <div class="col col-lg-1">10</div>
                        <div class="col col-lg-4">item 1</div>
                        <div class="col col-lg-2">59.56</div>
                        <div class="col col-lg-3"><input type="text" class="form-control"></div>
                        <div class="col col-lg-2"><a href="" class="btn btn-danger"><i class="icon icon-trash"></i></a></div>
                    </div>
                    <div class="row">
                        <div class="col col-lg-1">11</div>
                        <div class="col col-lg-4">item 1</div>
                        <div class="col col-lg-2">59.56</div>
                        <div class="col col-lg-3"><input type="text" class="form-control"></div>
                        <div class="col col-lg-2"><a href="" class="btn btn-danger"><i class="icon icon-trash"></i></a></div>
                    </div>
                    
                  
                   
                </div>
                
            </div>
            <div class="col col-lg-6  ">
                <div class="row">
                    <div class="col col-lg-4 btn btn-default">
                        <a ><i class="icon icon-briefcase"></i> <?php echo $this->lang->line('brand') ?></a>
                    </div>
                    <div class="col col-lg-4 btn btn-default">
                           <a class=""><i class="icon icon-briefcase"></i> <?php echo $this->lang->line('category') ?></a>
                    </div>
                    <div class="col col-lg-4 btn btn-default">
                           <a class=""><i class="icon icon-briefcase"></i> <?php echo $this->lang->line('item_department') ?></a>
                    </div>
                </div>
                <div class="row item_right " style="padding: 2px" id="stuff">
                    <div class="col col-lg-12">
                          <div class="row" >
                            <?php $i=0; foreach ($row as $item){ 
                                if($i%6==0){
                                    echo '  </div><div class="row" >';
                                }
                                $i++;
                                ?>
                            <div class=" btn btn-warning item">
                            <a class=""><?php echo $item['name']." <br>".$item['code']."<br><strong>".$this->session->userdata('currency_symbol')." ". $item['price']."</strong>" ?></a>
                            </div>
                           <?php } ?>
                          </div>
                          <div class="row" >
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
                          </div>
                          <div class="row" >
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
<div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div> <div class=" btn btn-warning item">     <a class="">item 4<br> 158<br><strong>$ 8080</strong></a></div>
                          </div>
                      
                           
                            
                       
                    </div>
                </div>
               
                <div class="row">
                    <div class="col col-lg-6" >
                        <div class="row item-amount" style="margin-right: 10px;margin-left:-15px;padding: 10px">
                            <div class="col col-lg-1">

                            </div>
                            <div class="col col-lg-6">
                                <h5><?php echo $this->lang->line('discount')?></h5>
                                <h5><?php echo $this->lang->line('tax_amount')?></h5>
                                <h4><?php echo $this->lang->line('total')?></h4>
                            </div>
                            <div class="col col-lg-4">
                               <h5> 56.98</h5>
                               <h5> 56.98</h5>
                               <h4> 56.98</h4>
                            </div>
                        </div>
                        <div class="row" style="margin-right:-5px">
                            <div class="col col-lg-6 ">
                                <div class="row " style="width: 100%">
                                    <a href="" class=" btn btn-info" style="width: 100%;padding-bottom: 14px; padding-top: 14px;"><i class="icon icon-gift"></i> <?php echo $this->lang->line('bill_discount') ?></a>
                                </div>
                                <div class="row " style="width: 100%">
                                    <a href="" class=" btn btn-danger" style="width: 100%;padding-bottom: 14px; padding-top: 14px;"><i class="icon icon-refresh"></i> <?php echo $this->lang->line('clear') ?></a>
                                </div>
                               
                            </div>
                            <div class="col col-lg-6">
                                <a href="" class=" btn btn-success" style="width: 100%;padding-bottom: 40px; padding-top: 40px;"><i class="icon icon-save"></i> <?php echo $this->lang->line('bill') ?></a>
                            </div>
                        </div>
                      
                    </div>
                    <div class="col col-lg-6">
                        <div class="row" style="margin-right: -15px">
                            <div class="col col-lg-5 btn btn-default"><a class=""><i class="icon icon-backward"></i> <?php echo $this->lang->line('previous') ?></a></div>
                            <div class="col col-lg-2"></div>
                            <div class="col col-lg-5 btn btn-default"><a ><?php echo $this->lang->line('next') ?> <i class="icon icon-forward"></i></a></div>
                        </div>
                        <div class="row" style="margin-right: -25px">
                            <div class="col col-lg-4 btn btn-default numbers" >1</div>
                            <div class="col col-lg-4 btn btn-default numbers">2</div>
                            <div class="col col-lg-4 btn btn-default numbers">3</div>
                            <div class="col col-lg-4 btn btn-default numbers">4</div>
                            <div class="col col-lg-4 btn btn-default numbers">5</div>
                            <div class="col col-lg-4 btn btn-default numbers">6</div>
                            <div class="col col-lg-4 btn btn-default numbers">7</div>
                            <div class="col col-lg-4 btn btn-default numbers">8</div>
                            <div class="col col-lg-4 btn btn-default numbers">9</div>
                            <div class="col col-lg-4 btn btn-default numbers">.</div>
                            <div class="col col-lg-4 btn btn-default numbers">0</div>
                            <div class="col col-lg-4 btn btn-default numbers"><?php echo $this->lang->line('clear'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-lg-1 ">
                 <a class="btn btn-danger"><i class="icon icon-off  "></i> </a>
            </div>
        </div>
    </div>
    
    
    
    
    <script>
        var x,y,top,left,down;
        $("#stuff").mousedown(function(e){
            e.preventDefault();
            down=true;
            x=e.pageX;
            y=e.pageY;
            top=$(this).scrollTop();
            left=$(this).scrollLeft();
        });

        $("body").mousemove(function(e){
            if(down){
                var newX=e.pageX;
                var newY=e.pageY;

                //console.log(y+", "+newY+", "+top+", "+(top+(newY-y)));

                $("#stuff").scrollTop(top-newY+y);    
                $("#stuff").scrollLeft(left-newX+x);    
            }
        });

        $("body").mouseup(function(e){down=false;});

    </script>
</body>

