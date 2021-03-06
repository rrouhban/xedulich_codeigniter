<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Danh sách hãng xe</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="table-responsive">
            <div role="grid">
              <div class="row" >
                <div class="col-sm-6" style=" height:55px;">
                  <button class="btn btn-danger" type="button" onclick='DeleteAll()'>Xóa tất cả</button>
                  <button class="btn btn-primary" type="button" onclick='Addhangxe()'>Thêm hãng xe </button>
                </div>
              </div>
              <?php if(!empty($results)): ?>
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr role="row">
                    <th style="width: 20px;"> <input type="checkbox" id='selecctall'/>
                    </th>
                    <th style="width: 220px;">Tên hãng xe</th>
                    <th style="width: 100px;">Thứ Tự</th>
                    <th style="width: 90px;">Trạng thái</th>
                    <th style="width: 130px;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($results as $key=>$info):
								$edit = base_url() . 'hangxe/capnhathangxe/'. $info->IDHangxe;
							?>
                  <tr class="gradeA odd">
                    <td><input type="checkbox" class='selected' name="selected[]" value="<?php echo $info->IDHangxe;?>"  /></td>
                    <td><?php echo $info->TenHangxe;?></td>
                    <td><?php echo $info->ThuTu;?></td>
                    <td class="center"><?php if($info->AnHien ==1){ ?>
                      <button class="btn btn-info btn-circle" type="button"><i class="fa fa-check"></i> </button>
                      <?php }else{ ?>
                      <button class="btn btn-warning btn-circle" type="button"><i class="fa fa-times"></i> </button>
                      <?php } ?></td>
                    <td class="center"><button class="btn btn-primary" onclick="Updatehangxe('<?php echo $edit;?>')" type="button">Cập nhật</button>
                      <button class="btn btn-danger" type="button" onclick="Deletehangxe('<?php echo $info->IDHangxe;?>')">Xóa</button></td>
                  </tr>
                  <?php endforeach;?>
                </tbody>
              </table>
              <?php if(!empty($pagination)):?>
              <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                  <div style="float:right"> <?php echo $pagination;?> </div>
                </div>
              </div>
              <?php endif; endif;?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#selecctall').click(function(event) {  
			if(this.checked) { // check select status
				$('.selected').each(function() { //loop through each checkbox
					this.checked = true;  //select all checkboxes with class "checkbox1"              
				});
			}else{
				$('.selected').each(function() { //loop through each checkbox
					this.checked = false; //deselect all checkboxes with class "checkbox1"                      
				});        
			}
		});	   
	});
	function DeleteAll()
	{
		var items = new Array();
		var n = jQuery(".selected:checked").length;
		if (n > 0){				
			jQuery(".selected:checked").each(function(){
				items.push($(this).val());
			});	
			return $.ajax({
				url: http + "hangxe/xoatatcahangxe",
				data:{items:items},
				type:"POST",
				dataType:"json",
				beforeSend:function(){},
			}).done(function(data){
				if(data==1){
					alert('Xóa dữ liệu thành công.');
					window.location.href = http + 'hangxe';
				}else{
					alert('Xóa dữ liệu không thành công. Vui lòng thực hiện lại.');
				}
			});
		}else{			
			alert('Vui lòng chọn dữ liệu để xóa.');						
		}
	}
	function Addhangxe()
	{
		window.location.href = http + 'hangxe/chitiethangxe';
	}
	function Updatehangxe(url)
	{
		window.location.href = url;
	}
	function Deletehangxe(id)
	{
		return $.ajax({
			url: http + "hangxe/xoahangxe",
			data:{id:id},
			type:"POST",
			dataType:"json",
			beforeSend:function(){},
		}).done(function(data){
			if(data==1){
				alert('Xóa dữ liệu thành công.');
				window.location.href = http + 'hangxe';
			}else{
				alert('Xóa dữ liệu không thành công. Vui lòng thực hiện lại.');
			}
		});
	}
</script>