window.onload = function() {
    let xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if (xhr.status == 200) {
            //mobile carousel
            groupCarousel = JSON.parse(xhr.responseText);
            console.log(groupCarousel);
            groupCardCarousel_1 = groupCarousel[0];
            groupCardCarousel_2 = groupCarousel[1];
            groupCardCarousel_3 = groupCarousel[2];
            groupCardCarousel_4 = groupCarousel[3];
            groupCardCarousel_5 = groupCarousel[4];

            new Vue({
                el: '#groupCardCarousel_1',
                data: {
                    groupCardCarousel_1,
                },
            });

            new Vue({
                el: '#groupCardCarousel_2',
                data: {
                    groupCardCarousel_2,
                },
            });

            new Vue({
                el: '#groupCardCarousel_3',
                data: {
                    groupCardCarousel_3,
                },
            });

            new Vue({
                el: '#groupCardCarousel_4',
                data: {
                    groupCardCarousel_4,
                },
            });

            new Vue({
                el: '#groupCardCarousel_5',
                data: {
                    groupCardCarousel_5,
                },
            });


        } else {
            alert(xhr.status);
        }
    };
    xhr.open("post", "group_carousel.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send();
};