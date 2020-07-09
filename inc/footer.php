		<!-- 底部版权区 -->
		<div class="footer clear">
			<div class="footer_cont">
				<div class="logo">
					<img src="images/logo.png" alt="">
				</div>
				<div class="info">
						<p>日照职业技术学院创意设计学院 </p>
						<p>地址：山东省日照市烟台路北16号楼地滋楼A区（276826）</p>
						<p>电话：0633-7987219（办公室）7987269（教学科）7987218（学生工作科、团总支）</p>
						<p>Copyright © 2014 School of Design and Innovation,Rizhao polytechnic.All Rights Reserved.</p>
				</div>
				<div class="line">
					<!-- <img src="images/line.png" alt=""> -->
				</div>
			</div>
		</div>
		<script src="js/jquery-3.1.1.min.js"></script>
		<script>
			$(document).ready(function () {
				//折叠导航
				$('.btn').on('click', function () {
					$('.nav').toggle(500);
				});
				// 给侧边栏赋等值高度
				var b_height = $('.box').css('height');
				$('.navside').css('height',b_height);
			});
		</script>
		<!-- 下拉菜单显隐 -->
		<script>
			$(document).ready(function () {
				$('.li').hover(function () {
					// over
					$(this).children('.second').show(200);
				}, function () {
					// out
					$(this).children('.second').hide(200);
				}
			);
			});
		</script>
		<!-- 下拉框链接跳转 -->
		<script>
			$(document).ready(function () {
				$('select').change(function () { 
					// var value = $('').val();
         			var value = $(this).children('option:selected').val();  
					if (value!="") {
						open(value,'_blank');				
					}
				});
			});
		</script>
		<script src="js/velocity.js"></script>
		<script src="js/shutter.js"></script>
		<script src="js/focus.js" async defer></script>
		<script>
			$(function () {
				$('.shutter').shutter({
					shutterW: 1000, // 容器宽度
					shutterH: 358, // 容器高度
					isAutoPlay: true, // 是否自动播放
					playInterval: 3000, // 自动播放时间
					curDisplay: 3, // 当前显示页
					fullPage: false // 是否全屏展示
				});
			});
		</script>
	</body>
</html>