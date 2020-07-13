<!-- <link rel="stylesheet" href="./setupGroup.css">  -->
<form class="setupform" action="#" method="get">
    <div class="startgroupall">
        <div class="startgroupa">
            <div class="startgtitle">開始揪團</div>
        </div>    
        <div class="startgroupcont">           
            <div class="startgroupn">選擇一個行程：
                <select name="shedulename" class="schedulename">
                    <option value="1" class="set1"selected>行程一</option>
                    <option value="2" class="set2">行程二</option>
                    <option value="3" class="set3"> 行程三</option>
                </select>
            </div>
            <div class="groupno">還沒有行程？&nbsp;&nbsp;&nbsp;
                <a href="./plan.html" class="gotosetup">去排行程</a>
            </div>
            請選擇一張美麗的封面照片
            <label for="file-upload" class="custom-file-upload">選擇照片</label>
            <input id="file-upload" type="file"/></br>
            <div class="plusfile"></div>
            <div class="selectreq">設定參團條件</div>
            <div class="selectreqst">
                <div class="reqpartend">報名期限：
                    <input id="date" type="date" style="width: 125px;height: 20px">
                </div>
                <div class="reqpartdep">出發日期：
                    <input id="date" type="date" style="width: 125px;height: 20px">
                </div>
                <div class="reqpartlimit">人數上限：
                    <input type="text" id="partlimit" name="partlimit" style="height: 20px; width: 125px">
                </div>
            </div>
            <div class="selectreq2">
                <div class="genderlimit">性別限制：
                    <select name="gendercho" style="width: 125px;height: 20px" class="gendselect">
                        <option value="female" class="gendf"selected>女</option>
                        <option value="male" class="gendm">男</option>
                        <option value="none" class="gendnone">不限</option>
                    </select>
                </div>
                <div class="yearlimit">年紀限制：
                    <input type="text" id="yearlimitcho" name="yearchoice" style="height: 20px; width: 125px" class="yearinput">
                </div>
                <div class="estimatecost">預估費用：
                    <input type="text" id="estmoney" name="estmoney" style="height: 20px; width: 125px" class="inputmoney">
                </div>
            </div>
            <div class="selectreq3">
                <div class="noticetext" style="clear:both">備註：</div>
                <div class="noticetexta"><textarea class="noticetxthere"></textarea></div> 
                <div class="threestatus">
                    <button  value="submit" class="setgroupadd">發佈</button>
                    <button  value="submit"class="setgroupsave">儲存</button>
                    <button onclick="closeNewGroup();"  value="reset" class="setgroupcancel">取消</button>
                </div>
            </div>
        </div>
    </div>
 </form>