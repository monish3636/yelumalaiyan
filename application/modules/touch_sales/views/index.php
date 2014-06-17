<style type="text/css">
    
    .header{
        background: #405b75;
        overflow-x: hidden;
      //  overflow-y: hidden;
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
        //margin-top: 5px;
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
        width: 100%;
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
    .customers_select{
        height: 560px;
    }
    .select2-results {
        max-height: 518px;
    }
    .select2-container .select2-choice {    
        height: 44px;
        line-height: 44px;
      text-align: center;
    }
    .select2-container .select2-choice div {
        width: 36px;
    }
    .select2-container .select2-choice div b {
        background: url("template/app/select/Search.png") no-repeat scroll 0 1px rgba(0, 0, 0, 0);
        display: block;
        height: 100%;
        width: 100%;
    }
    .item_select{
        height: 559px;
        width: 393px !important;
    }
    .keyboard-key{
        height: 66px;
        width: 70px;
        border-radius: 8px;
        font-size: 16px;
        margin: 2px;
        padding: 22px;
    }
    .keyboard-key-enter{
        height: 66px;
        width: 117%;
        border-radius: 8px;
        font-size: 16px;
        margin: 2px;
        padding: 22px;
    }
    .keyboard-key-submit{
        height: 66px;
        width: 117%;
        border-radius: 8px;
        font-size: 16px;
        margin: 2px;
        margin-left: 15px;
        padding: 22px;
    }
    .keyboard-key-space{
        height: 66px;
        width: 100%;
        border-radius: 8px;
        font-size: 16px;
        margin: 2px;
        padding: 22px;
    }
    .keyboard-key-clear{
        height: 66px;
        width: 100%;
        border-radius: 8px;
        font-size: 16px;
        margin: 2px;
        padding: 22px;
    }
    .keyboard-key-div{
        padding-left: 0px;
        padding-left: 0px;
    }
    .keyboard-key-row{
        margin-left: 0;
        margin-right: 0px;
        margin-top: -22px;
    }
    .keyboard-modal
    {
        width: 900px;
        background: #e3eaf3;
        border-radius: 8px;
        margin-top: 29.3%;
    }
    .modal-dialog {
        padding-bottom: 8px;
    }
    .modal {
        overflow-y: hidden;
    }
</style>
<body class="header">
    <div id="container " >

        <br>
        <div class="row header-bar">
            <div class="col col-lg-1 ">
            </div>
            <div class="col col-lg-4 ">
                <div class="row" style="margin: 33px 10px 10px -10px;">
                    <div class="input-group search-input" >
                        <span class="input-group-addon" style="width:  43px"><i class="icon icon-user icon-2x"></i></span>
                        <input id="customer" class="form-control search-input" type="text">
                        
                    </div>
                </div>
                <div class="row" style="margin: 10px 10px 10px -10px;">
                    <div class="input-group search-input" >
                        <span class="input-group-addon" style="width:  43px"><i class="icon icon-shopping-cart icon-2x"></i></span>
                        <input id="search_items" class="form-control search-input" type="text">
                        
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
                 <a href="javascript:show_key_board()" class="btn btn-danger"><i class="icon icon-off  "></i> </a>
            </div>
        </div>
    </div>
    
    
    <div class="modal fade" id="keyboard">
        <div class="modal-dialog keyboard-modal"  >
            <div class="row keyboard-key-row">
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">Q</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">W</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">E</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">R</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">T</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">Y</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">U</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">I</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">O</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">P</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key"><-</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">DEL</a></div>
             
            </div>
            <div class="row keyboard-key-row">
                <div class="col col-lg-1 keyboard-key-div" style="margin-left: 34px"><a href="" class="btn btn-default keyboard-key">Q</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">W</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">E</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">R</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">T</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">Y</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">U</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">I</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">O</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">P</a></div>
                <div class="col col-lg-2 keyboard-key-div" style="width: 109px"><a href="" class="btn btn-default keyboard-key-enter">Enter</a></div>               
             
            </div>
             <div class="row keyboard-key-row">
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">abc</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">Z</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">X</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">C</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">V</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">B</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">N</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">M</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">,</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">.</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">'</a></div>
                <div class="col col-lg-1 keyboard-key-div"><a href="" class="btn btn-default keyboard-key">123</a></div>
             
            </div>
            <div class="row keyboard-key-row">
                <div class="col col-lg-2 keyboard-key-div" style="margin-left: 34px"><a href="" class="btn btn-danger keyboard-key-clear">Clear</a></div>
              
                <div class="col col-lg-6 keyboard-key-div"><a href="" class="btn btn-default keyboard-key-space"> </a></div>
                <div class="col col-lg-2 keyboard-key-div" style="width: 109px"><a href="" class="btn btn-default keyboard-key-enter">#$@</a></div>               
                <div class="col col-lg-2 keyboard-key-div" style="width: 109px"><a href="" class="btn btn-success keyboard-key-submit">Submit</a></div>               
             
            </div>
        </div>
    </div>
    
    <script>
        function show_key_board(){
            $('#keyboard').modal('show');
        }
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


