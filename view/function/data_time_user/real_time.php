<script type="text/javascript">
$(function(){
	setInterval(function(){ // เขียนฟังก์ชัน javascript ให้ทำงานทุก ๆ 30 วินาที
		// 1 วินาที่ เท่า 1000
		// คำสั่งที่ต้องการให้ทำงาน ทุก ๆ 3 วินาที
		var getData=$.ajax({ // ใช้ ajax ด้วย jQuery ดึงข้อมูลจากฐานข้อมูล
				url:"view/function/data_time_user/data_time.php",
				data:"rev=1",
				async:false,
				success:function(getData){
					$("div#showData").html(getData); // ส่วนที่ 3 นำข้อมูลมาแสดง
				}
		}).responseText;
	},1000);	
});
</script>	
