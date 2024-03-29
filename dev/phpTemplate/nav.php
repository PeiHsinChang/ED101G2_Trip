<div class="mainBody">
  <div class="navBg">   
    <nav class="nav">
      <div class="navLeft">
        <a class="nav-link" href="main.html">         
          <img src="./images/logo.png" alt="">
          <div class="daijoubu">
            <div class="daijoubuMd">自助大丈夫</div>
            <div class="daijoubuEn">Easy Planning Trip</div>           
          </div>
        </a>
      </div>
      <div class="navCenter">
        <a class="nav-link active nav-linkplan" href="plan.html">排行程</a>
        <a class="nav-link nav-linkgroupView" href="groupView.html">揪團</a>
        <a class="nav-link nav-linkblogView" href="blogView.html">遊記</a>
        <a class="nav-link nav-linkMember" id="nav-linkMember">會員專區</a>
      </div>
      <div class="navRight">
        <a id="aLogin" class="nav-link" style="text-decoration: none;" data-toggle="modal" data-target="#loginForm"><img src="./images/login.png" alt="">登入</a>
        <div id="memberPic"></div>
        <a id="aRegist" class="nav-link" style="text-decoration: none;" data-toggle="modal" data-target="#registerForm"><img src="./images/member.png" alt="">註冊</a>
      </div>
    </nav>
    <!-- 漢堡導覽列 -->
    <div class="navSmall">
      <div class="navSmallLeft">
        <button class="hamburger hamburger--collapse " type="button">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
        </button>
        <div id="panel">		
          <a href="plan.html">排行程</a> 
          <a href="groupView.html">揪團</a>
          <a href="blogView.html">遊記</a>
          <a id="navSmallMember">會員專區</a>
          <hr>
          <a class="nav-link navSmallRight" style="text-decoration:none;transform:translateX(10px);" data-toggle="modal" data-target="#loginForm">登入</a>
          <a class="nav-link navSmallRight1" id="qwer" style="text-decoration:none;transform:translateX(10px);" data-toggle="modal" data-target="#registerForm">註冊</a>
        </div>
      </div>
      <a class="navSmallCenter" href="main.html"><img src="./images/logo.png" alt=""></a>
      <div>
        <!-- <a class="nav-link navSmallRight" style="text-decoration:none;" data-toggle="modal" data-target="#loginForm">登入</a>
        <a class="nav-link navSmallRight1" id="qwer" style="text-decoration:none;" data-toggle="modal" data-target="#registerForm">註冊</a> -->
      </div>
      <!-- <a class="nav-link navSmallRight" style="text-decoration:none;" data-toggle="modal" data-target="#loginForm">登入</a> -->
    </div>
    <div class="container">
      <div class="modal fade" id="loginForm" role="dialog">
        <div class="modal-dialog">
          <!-- 登入燈箱 -->
          <div id="loginLightBox" class="modal-content">
              <form action="#" method="get" class="loginform">
                <div class="loginall">
                <div class="loginnamea">
                    <div class="logintitle">會員登入</div>
                </div>    
                    <div class="logincont">           
                        <div class="loginacc">帳號：<input type="text" name="loginacc" size="10" class="loginacc" id="memId" style="margin: 1px;"></div>
                        <div class="loginpsdw">密碼：<input type="text" name="loginpsdw" size="10" class="loginpsdw" id="memPsw" style="margin: 1px;"></div>
                        <div class="logintwobtn">
                        <button type="button" value="Submit"  id="loginbutton" class="loginleftbutton">送出</button>
                        <button type="reset" value="Reset" class="loginrightbutton" id="loginrightbutton" data-dismiss="modal">取消</button>
                        </div>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>

    <div class="modal fade" id="registerForm" role="dialog">
      <div class="modal-dialog">
        <!-- 註冊燈箱 -->
        <div class="modal-content">
            <form action="regist.php" method="post" class="enrollfrom" id="enrollfrom" name="enrollfrom" onclick="return false">
              <div class="enrollall">
              <div class="enrollnamea">
                  <div class="enrolltitle">會員註冊</div>
              </div>    
                  <div class="enrollcont">           
                      <div class="enrollname">名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;稱：<input type="text" class="textbox" id="r_memName" name="r_memName" size="10" style="margin: 1px;" autocomplete="off"></div>                     
                      <div class="enrollacc">帳&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;號：<input type="text" class="accbox" id="r_memId" name="r_memId" size="10" style="margin: 1px;" autocomplete="off"></div>  
                      <div id="accountCheck" style="font-size:12px;"></div>              
                      <div class="enrollpsdw">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;碼：<input type="text" class="psdwbox" id="r_memPsw" name="r_memPsw" size="10" style="margin: 1px;" autocomplete="off"></div>
                      <div id="passwordCheck" style="font-size:12px;"></div>
                      <div class="psdwconf">確認密碼：<input type="text" class="accconbox" id="r_memPsw2" name="r_memPsw2" size="10" style="margin: 1px;" autocomplete="off"></div>
                      <div id="passwordCheck2" style="font-size:12px;"></div>
                      <div class="enrollgend">性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;別：
                          <input type="radio" id="male" name="r_memSex" value="1">
                          <label id="maleradio" for="male">男</label>
                          <input type="radio" id="female" name="r_memSex" value="2">
                          <label id="femaleradio" for="female">女</label>     
                      </div>
                      <div class="enrollmail">聯絡信箱：<input type="email" class="emailbox" id="r_memEmail" name="r_memEmail" size="10" style="margin: 1px;" autocomplete="off"></div>
                      <div id="emailCheck" style="font-size:12px;"></div>
                      <div class="enrollmail">聯絡電話：<input type="tel" class="phonebox" id="r_memTel" name="r_memTel" size="10" style="margin: 1px;" autocomplete="off"></div>
                      <div id="phoneCheck" style="font-size:12px;"></div>
                      <div class="enrollbirth">生&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日：<input type="text" class="birthbox" id="r_memBirth" placeholder=" YYYY-MM-DD" name="r_memBirth" size="10" autocomplete="off"></div>
                      <div id="birthCheck" style="font-size:12px;"></div>  
                      <div class="enrolltwobtn">
                          <button type="submit" value="Submit" class="enrollleftbutton">送出</button>
                          <button type="reset" value="Reset" class="enrollrightbutton loginrightbutton" id="registrightbutton" data-dismiss="modal">取消</button>
                      </div>
                  </div>
              </div>
          </form>
        </div>
      </div>
  </div>
</div>   
</div> 