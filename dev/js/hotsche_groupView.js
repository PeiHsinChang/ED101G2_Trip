window.onload = function hotSche() {
    //點開頁面就要load
    var xhr = new XMLHttpRequest();
    //發出ajax請求要資料
    xhr.onload = function () {
        if (xhr.status == 200) {
            //如果資料傳送成功
            hotSchePackage = JSON.parse(xhr.responseText);
            // console.log(hotSchePackage);
            // console.log(hotSchePackage[4]);
            hotSche001 = hotSchePackage[0];
            hotSche002 = hotSchePackage[1];
            hotSche003 = hotSchePackage[2];
            new Vue({
                el: '#hotSche001',
                data: {
                    hotSche001,
                },
                computed: {

                },
            });
            new Vue({
                el: '#hotSche002',
                data: {
                    hotSche002,
                },
                computed: {

                },
            });
            new Vue({
                el: '#hotSche003',
                data: {
                    hotSche003,
                },
                computed: {

                },
            });





        } else {
            alert(xhr.status);
            //如果資料傳送失敗的話顯示原因
        }
    };
    xhr.open("post", "groupViewHotSche.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send(); //因為開太快所以要送個空值回去
};