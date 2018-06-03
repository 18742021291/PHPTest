<?php require "../control/validate.php";?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<style>
    *{margin:0;padding:0;}
    .msg{width:800px;margin:50px auto;}
    table{width:800px;height:200px;border-collapse:collapse;text-align:center;}
    table tr td{width:70px;border:1px solid #999;}
    ul{width:550px;height:20px;margin-top:20px;float:right;}
    ul li{width:50px;height:20px;line-height:20px;text-align:center;float:left;list-style:none;font-size:14px;border:1px solid #999;margin-left:5px;cursor:pointer;}
    ul .jump{width:50px;height:20px;border:0;}
    .text{width:250px;height:20px;line-height:20px;text-align:left;font-size:14px;float:left;margin-top:20px;}
</style>

<body>
<div class="msg">
    <table>
        <tr>
            <td>序号</td>
            <td>城市编号</td>
            <td>房屋编号</td>
            <td>经理人</td>
            <td>门店</td>
            <td>创建日期</td>
            <td>购买房产</td>
        </tr>
    </table>
    <div class="btn-fy">
        <div class="text"></div>
        <ul class="page">
            <li class="firstPage">第一页</li>
            <li class="prePage">上一页</li>
            <li class="nextPage">下一页</li>
            <li class="lastPage">尾页</li>
            <li><select class="jump"></select></li>
            <li class="jumpPage">跳转</li>
        </ul>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="../script/jquery.min.js"></script>
<script type="text/javascript">
    var page=1;
    var totalPage;
    function buy(obj) {
        var house_id=$(obj).parent().parent().children().eq(0).html();
        var houseId=Number(house_id);
        $.ajax({
            type:'POST',
            url:'../router/housing_Buy.php',
            data:{"houseId":houseId},
            dataType:'JSON',
            success:function(result){
                switch (result){
                    case 1:
                        alert("购买成功!");
                        break;
                    case 2:
                        alert("购买失败!");
                        break;
                }
            }
        })
    }
    window.onload=function(){
        getData(page)
        function getData(page){
            $.ajax({
                type: 'POST',
                url: '../router/housing_Info.php',
                data: {'page':page},
                dataType:'json',
                success:function(data){
                    //通过json传递过来
                    totalPage =data[0].totalPage;//分页条数
                    var count=data[0].count;//数据总条数据
                    var num=data.length;
                    var str= "<tr><td>" + "序号" +"</td><td>" + "城市编号" +"</td><td>" + "房屋编号" + "</td><td>" + "经理人" +"</td><td>" + "门店"+"</td><td>" + "创建日期" + "</td><td>" + "购买房产" + "</td></tr>";
                    for(var i=0;i<num;i++){
                        str+="<tr><td>" + data[i].Id +"</td><td>" + data[i].city_code +"</td><td>" + data[i].house_no + "</td><td>" + data[i].assignee_name +"</td><td>" + data[i].address +"</td><td>" + data[i].create_at + "</td><td><button id=i onclick='buy(this)'>购买</button></td></tr>";
                    }
                    var text = "共"+count+"条记录 分"+totalPage+"页 当前第"+page+"页";
                    $(".msg table").html(str);
                    $(".msg .text").html(text);
                    var option="";
                    for(var i=1;i<=totalPage;i++){
                        option+='<option value='+i+'>'+i+'</option>'
                    }
                    $(".jump").html(option);
                    if(page<1){
                        page=1;
                    };
                    if(page>totalPage+1){
                        page=totalPage;
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    // 状态码
                    console.log(XMLHttpRequest.status);
                    // 状态
                    console.log(XMLHttpRequest.readyState);
                    // 错误信息
                    console.log(textStatus);
                }
            })

            return page;
        }
        $(".page .nextPage").click(function(){
            page++;
            if(page>totalPage){
                page=totalPage;
                getData(page)
            }else{
                getData(page)
            }

        })
        $(".page .firstPage").click(function(){
            getData(1);
        })
        $(".prePage").click(function(){
            page --;
            if(page<1){
                page=1;
                getData(page)
            }else{
                getData(page)
            }
        })
        $(".lastPage").on("click",function(){
            getData(totalPage);
        })
        $(".jumpPage").click(function(){
            var s=parseInt($(".jump").val());
            if(s!=page){
                getData(s);
            }
        })


    }
</script>
