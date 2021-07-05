<div class="grid-list-top border-default universal-padding d-md-flex justify-content-md-between align-items-center mb-30" style="background:#f8f8f8">
    <div class="grid-list-view  mb-sm-15">
    </div>
    <!-- Toolbar Short Area Start -->
    <div class="main-toolbar-sorter clearfix">
        <div class="toolbar-sorter d-flex align-items-center">
            <label>Sắp xếp:</label>
            <select   id="order_by" name="order_by">
                <option value="0" selected="">Mặc định</option>
                <option value="1">Tên, A tới Z</option>
                <option value="2">Tên, Z tới A</option>
                <option value="3" <?php if(isset($selected_order)){	if ($selected_order == 1){ echo "selected"; } } ?>>Giá từ thấp đến cao</option>
                <option value="4" <?php if(isset($selected_order)){	if ($selected_order == 2){ echo "selected"; } } ?>>Giá từ cao đến thấp</option>
            </select>
        </div>
    </div>
    <!-- Toolbar Short Area End -->
</div>
<script>
	$('#order_by').on('change', function() {
	  $('input[name=order_product_by]').val(this.value);
	  $('#product_filter_form').submit();	  	  
	});
</script>