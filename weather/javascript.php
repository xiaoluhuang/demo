<?php
/**
 *  实现三级联动的脚本
 */
require_once 'general.php';
require_once 'claw.php';


$claw = new Claw();
$city_id = $_POST['las_sel'];
$city = $name_array[$city_id-1];
$weather = $claw->getWeather($city);

var_dump($weather);
?>
<html>
<head>
    <title>天气查询</title>

</head>

<body onLoad="create_select(0,'top_sel',0),create_sel(0)">
<form name="my_form" method="post" action="javascript.php">
    <select id="top_sel" name="top_sel" onChange="create_select(this.value,'las_sel',1)">
        <option value="">请选择省份</option>
    </select>
    <select id="las_sel" name="las_sel">
        <option value="">请选择城市</option>
    </select>
    <input type="submit" value="提交">
</form>
<div><?= $weather ?></div>
</body>
<script type="text/javascript">
    //*测试数据
    var id_array,name_array,parent_array;
    id_array = <?= $id ?>;
    name_array = <?= $name ?>;
    parent_array = <?= $parent ?>;

    /****三级版****/
    function create_select(parent_id,sel_id,what_sel){
        var new_option;
        if(parent_id === ""){
            return;
        }
        if(what_sel == 1){
            document.getElementById("las_sel").options.length = 0;
            new_option = new Option("请选择城市","");
            document.getElementById("las_sel").options.add(new_option);

        }
        for(var j = 0; j < id_array.length; j++){
            if(parent_array[j] == parent_id){
                new_option = new Option(name_array[j],id_array[j]);
                document.getElementById(sel_id).options.add(new_option);
            }
        }
    }
</script>
</html>

