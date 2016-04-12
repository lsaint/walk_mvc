<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="" name="keywords">
<meta content="" name="description">
<meta http-equiv="pragma" content="no-cache">
<title>广发卡名品半价购</title>
{!! HTML::style("css/pc_global.css") !!}
{!! HTML::style("css/pc_index.css") !!}
<script type="text/javascript" src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    wx.config({!! $js->config(array('onMenuShareAppMessage', 'onMenuShareTimeline'), true) !!});
    wx.ready(function(){
        wx.onMenuShareAppMessage({
            title: 'Laravel Wechat test',
            desc: '你的内心是六爷、小飞还是晓波呢？',
            link: 'http://test.huocc.com/', // 分享链接
            //imgUrl: 'img/mrsix.jpg', // 分享图标
        });
    });
</script>
<script>
       $.ajaxSetup({cache:false});
       function addKannma(number) {
         var num = number + "";
         num = num.replace(new RegExp(",","g"),"");
         // 正负号处理
         var symble = "";
         if(/^([-+]).*$/.test(num)) {
             symble = num.replace(/^([-+]).*$/,"$1");
             num = num.replace(/^([-+])(.*)$/,"$2");
         }

         if(/^[0-9]+(\.[0-9]+)?$/.test(num)) {
             var num = num.replace(new RegExp("^[0]+","g"),"");
             if(/^\./.test(num)) {
             num = "0" + num;
             }

             var decimal = num.replace(/^[0-9]+(\.[0-9]+)?$/,"$1");
             var integer= num.replace(/^([0-9]+)(\.[0-9]+)?$/,"$1");

             var re=/(\d+)(\d{3})/;

             while(re.test(integer)){
                 integer = integer.replace(re,"$1,$2");
             }
             return symble + integer + decimal;

         } else {
             return number;
         }
     }

        //生成商品li
        function createLi(data,type){
                var result="";
                if(data!=undefined){
                switch (type){
                    case 1:
                        for( var i=0;i<data.length;i++){
                            result=result+"<li class='"+(i%3==0?"mgl0":"mgl13")+"'>"+
                                            "<img  onclick='window.open(\"/item/"+data[i][0]+"\")' style='width:318px;cursor:pointer;' src='"+data[i][3]+"' alt='goods'>"+
                                                "<div>"+
                                                    "<h3>"+data[i][1]+"</h3>"+
                                                    "<p class='oriPrice'>原价￥"+data[i][4]+"或"+addKannma(data[i][6])+"积分</p>"+
                                                    "<p class='actPrice'>活动价<b>￥"+data[i][5]+"</b>或"+addKannma(data[i][7])+"积分</p>"+
                                                    "<a target='_blank' class='look' href='/item/"+data[i][0]+"'>立即查看</a>"+
                                                "</div>"+
                                            "</li>";
                        }
                        break;
                    case 2:
                        for(var i=0;i<data.length;i++){
                            result=result+"<li class='"+(i%3==0?"mgl0":"mgl13")+"'>"+
                                            "<img  onclick='window.open(\"/item/"+data[i][0]+"\")'  style='width:318px;cursor:pointer;' src='"+data[i][3]+"' alt='goods'>"+
                                                "<div>"+
                                                    "<h3>"+data[i][1]+"</h3>"+
                                                    "<p class='oriPrice'>原价￥"+data[i][4]+"</p>"+
                                                    "<p class='actPrice'>活动价<b>￥"+data[i][5]+"</b></p>"+
                                                    "<a target='_blank' class='look' href='/item/"+data[i][0]+"'>立即查看</a>"+
                                                "</div>"+
                                            "</li>";
                        }
                        break;
                    case 3:
                        for( var i=0;i<data.length;i++){
                           result=result+"<li class='"+(i%3==0?"mgl0":"mgl13")+"'>"+
                                            "<img  onclick='window.open(\"/item/"+data[i][0]+"\")'  style='width:318px;cursor:pointer;' src='"+data[i][3]+"' alt='goods'>"+
                                                "<div>"+
                                                    "<a target='_blank' class='look' href='/item/"+data[i][0]+"'>立即查看</a>"+
                                                "</div>"+
                                            "</li>";
                        }
                        break;


                }
                }
                return result;

            }
        //追加到页面
        function addToUl(jsonObject,type){

                if(type==1){

                    $("#sc_mz").append(createLi(jsonObject[4],type));
                    $("#sc_jjsh").append(createLi(jsonObject[5],type));
                    $("#sc_sm").append(createLi(jsonObject[1],type));
                    $("#sc_ms").append(createLi(jsonObject[2],type));
                    $("#sc_psxb").append(createLi(jsonObject[3],type));
                }
                else if(type==2){

                    $("#ht_fsxb").append(createLi(jsonObject[6],type));
                    $("#ht_jjsh").append(createLi(jsonObject[7],type));
                    $("#ht_mz").append(createLi(jsonObject[8],type));
                    $("#ht_my").append(createLi(jsonObject[9],type));
                    $("#ht_yybj").append(createLi(jsonObject[10],type));
                }
                else if(type==3){

                    $("#jf_cs").append(createLi(jsonObject[11],type));
                    $("#jf_bld").append(createLi(jsonObject[12],type));
                    $("#jf_cy").append(createLi(jsonObject[13],type));
                    $("#jf_dgtp").append(createLi(jsonObject[14],type));
                }

            }
        //请求商品信息 type→1:商场半价 2:海淘半价 3:积分POS半价
        function getProduct(type){
            var jsonObject="";
             $.get("/pullitems/" +type, function (result) {
                    if (result != "") {
                        addToUl(result,type);
                    }
            });
            return jsonObject;
        }
     $(function(){
        getProduct(1);
        getProduct(2);
        getProduct(3);
    });

</script>

</head>

<body>

<div id="main">
	<!--begin of top -->
	<div class="top">
		<img src="{!! URL::asset('/img/20zhounian.jpg') !!}" alt="广发卡商城">
	</div>
	<!--end of top -->

	<!--begin of nav -->
	<div class="nav">
        <a href="javascript:void(0)" class="actived" con="shop" id="shopBtn"><img  src="{!! URL::asset('/img/nav_01.png') !!}" alt="商城半价"></a>
		<a href="javascript:void(0)" class="" id="haitaoBtn" con="haitao"><img     src="{!! URL::asset('/img/nav_02.png') !!}" alt="海淘半价"></a>
		<a href="javascript:void(0)" class="" id="integralBtn" con="integral"><img src="{!! URL::asset('/img/nav_03.png') !!}" alt="积分半价"></a>
	</div>
	<!--end of nav -->

	<!-- begin of content-->
	<div class="content" id="shop">
		<div class="floorGoods">
			<div class="floorHead">
				<span class="mgt26"></span>
				<h2 class="mgt26">美妆</h2>
				<p class="mgt26">限时抢购至3月31日，每天10点-23点</p>
                <a target="_blank" href="/pc_rules?type=linkSCAlert" class="rules_btn">活动细则</a>
                <a target="_blank" href="http://www.cgbchina.com.cn/jsp/include/CN2/creditcard/rewardCheck.jsp?tid=20372461" class="rules_btn">奖励查询</a>
			</div>
			<ul id="sc_mz" class="goodsContent">

			</ul>
		</div>
		<div class="floorGoods">
			<div class="floorHead">
				<span class="mgt26"></span>
				<h2 class="mgt26">居家生活</h2>
				<p class="mgt26">限时抢购至3月31日，每天10点-23点</p>
			</div>
			<ul id="sc_jjsh" class="goodsContent">

			</ul>
		</div>

		<div class="floorGoods">
			<div class="floorHead">
				<span class="mgt26"></span>
				<h2 class="mgt26">数码</h2>
				<p class="mgt26">限时抢购至3月31日，每天10点-23点</p>
			</div>
			<ul id="sc_sm" class="goodsContent">

			</ul>
		</div>

        <div class="floorGoods">
			<div class="floorHead">
				<span class="mgt26"></span>
				<h2 class="mgt26">美食</h2>
				<p class="mgt26">限时抢购至3月31日，每天10点-23点</p>
			</div>
			<ul id="sc_ms" class="goodsContent">

			</ul>
		</div>

        <div class="floorGoods">
			<div class="floorHead">
				<span class="mgt26"></span>
				<h2 class="mgt26">配饰箱包</h2>
				<p class="mgt26">限时抢购至3月31日，每天10点-23点</p>
			</div>
			<ul id="sc_psxb" class="goodsContent">

			</ul>
		</div>
        <!-- <p class="mgt26" style="font-size: 18px;color: #6e6e6e;">接商户通知：受春节假期的影响，物流周期会有所延长，具体情况请咨询对应商户，感谢您的谅解！</p> -->
    </div>

	<div class="content" id="haitao">
         <div class="floorGoods">
			<div class="floorHead">
				<span class="mgt26"></span>
				<h2 class="mgt26">营养保健</h2>
				<p class="mgt26">每周四上新，限时抢购：2016.3.24日10点-2016.3.31日23点</p>
                <a target="_blank" href="/pc_rules?type=linkHTAlert" class="rules_btn">活动细则</a>
                <a target="_blank" href="http://www.cgbchina.com.cn/jsp/include/CN2/creditcard/rewardCheck.jsp?tid=20372435" class="rules_btn">奖励查询</a>
			</div>
			<ul id="ht_yybj" class="goodsContent">

			</ul>
		</div>

		<div class="floorGoods">
			<div class="floorHead">
				<span class="mgt26"></span>
				<h2 class="mgt26">服饰鞋包</h2>
				<p class="mgt26">每周四上新，限时抢购：2016.3.24日10点-2016.3.31日23点</p>
			</div>
			<ul id="ht_fsxb" class="goodsContent">

			</ul>
		</div>

		<div class="floorGoods">
			<div class="floorHead">
				<span class="mgt26"></span>
				<h2 class="mgt26">美妆</h2>
				<p class="mgt26">每周四上新，限时抢购：2016.3.24日10点-2016.3.31日23点</p>
			</div>
			<ul id="ht_mz" class="goodsContent">

			</ul>
		</div>

		<div class="floorGoods">
			<div class="floorHead">
				<span class="mgt26"></span>
				<h2 class="mgt26">母婴</h2>
				<p class="mgt26">每周四上新，限时抢购：2016.3.24日10点-2016.3.31日23点</p>
			</div>
			<ul id="ht_my" class="goodsContent">

			</ul>
		</div>



        <div class="floorGoods">
			<div class="floorHead">
				<span class="mgt26"></span>
				<h2 class="mgt26">居家生活</h2>
				<p class="mgt26">每周四上新，限时抢购：2016.3.24日10点-2016.3.31日23点</p>
			</div>
			<ul id="ht_jjsh" class="goodsContent">

			</ul>
		</div>
       <!--  <p class="mgt26" style="font-size: 18px;color: #6e6e6e;">接商户通知：受春节假期的影响，物流周期会有所延长，具体情况请咨询对应商户，感谢您的谅解！</p> -->
    </div>

	<div class="content" id="integral">
        <div class="floorGoods">
			<div class="floorHead">
				<span class="mgt26"></span>
				<h2 class="mgt26">超市</h2>
                 <a target="_blank" href="/pc_rules?type=linkJFAlert" class="rules_btn">活动细则</a>
                <a target="_blank" href="http://www.cgbchina.com.cn/jsp/include/CN2/creditcard/rewardCheck.jsp?tid=20372487" class="rules_btn">奖励查询</a>
			</div>
			<ul id="jf_cs" class="goodsContent">

			</ul>
		</div>

		<div class="floorGoods">
			<div class="floorHead">
				<span class="mgt26"></span>
				<h2 class="mgt26">蛋糕甜品</h2>

			</div>
			<ul id="jf_dgtp" class="goodsContent">

			</ul>
		</div>

        <div class="floorGoods">
			<div class="floorHead">
				<span class="mgt26"></span>
				<h2 class="mgt26">便利店</h2>
			</div>
			<ul id="jf_bld" class="goodsContent">

			</ul>
		</div>

        <div class="floorGoods">
			<div class="floorHead">
				<span class="mgt26"></span>
				<h2 class="mgt26">餐饮</h2>
			</div>
			<ul id="jf_cy" class="goodsContent">

			</ul>
		</div>


	</div>

	<!-- end of content-->
 <div style="display:none" >
            <script src="http://s4.cnzz.com/z_stat.php?id=1256751266&web_id=1256751266" language="JavaScript"></script>
        </div>
</div>

<script>
	$(document).ready(function(){
		$('#shopBtn').click(changeNav);
		$('#haitaoBtn').click(changeNav);
		$('#integralBtn').click(changeNav);
	});
	function changeNav(){
		var conArray = ['shop','haitao','integral']
		var className = $(this).attr('class');
		var con = $(this).attr('con');
		if(className != 'actived'){
			$(this).attr('class','actived');
			$('#'+con).show();
			for(var i=0;i<conArray.length;i++){
				if(conArray[i] == con){
					conArray.splice(i,1);
					break;
				}
			}

			for(var n=0;n<conArray.length;n++){
				$('#'+conArray[n]).hide();
				$('#'+conArray[n]+'Btn').attr('class','');
			}
		}
	}
</script>

</body>
</html>
