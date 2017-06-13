<?php
/**
 *  实现三级联动的脚本
 */
require_once 'insertCity.php';
?>
<html>
<head>
    <title>查看天气</title>
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
                document.getElementById("mid_sel").options.length = 0;
                document.getElementById("bot_sel").options.length = 0;
                document.getElementById("las_sel").options.length = 0;
                new_option = new Option("请选择版本","");
                document.getElementById("mid_sel").options.add(new_option);
                new_option = new Option("请选择年级","");
                document.getElementById("bot_sel").options.add(new_option);
                new_option = new Option("请选择单元","");
                document.getElementById("las_sel").options.add(new_option);

            }
            if(what_sel == 2){
                document.getElementById("bot_sel").options.length = 0;
                document.getElementById("las_sel").options.length = 0;
                new_option = new Option("请选择年级","");
                document.getElementById("bot_sel").options.add(new_option);
                new_option = new Option("请选择单元","");
                document.getElementById("las_sel").options.add(new_option);
            }
            if(what_sel == 3){
                document.getElementById("las_sel").options.length = 0;
                new_option = new Option("请选择单元","");
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
</head>

<body onLoad="create_select(0,'top_sel',0),create_sel(0)">
<form name="my_form" method="post" action="create_sel.php">
    <select id="top_sel" name="top_sel" onChange="create_select(this.value,'mid_sel',1)">
        <option value="">请选择阶段</option>
    </select>
    <select id="mid_sel" name="mid_sel" onChange="create_select(this.value,'bot_sel',2)">
        <option value="">请选择版本</option>
    </select>
    <select id="bot_sel" name="bot_sel" onChange="create_select(this.value,'las_sel',3)">
        <option value="">请选择年级</option>
    </select>
    <select id="las_sel" name="las_sel">
        <option value="">请选择单元</option>
    </select>
</form>
</body>
</html>