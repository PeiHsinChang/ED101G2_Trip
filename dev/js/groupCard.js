window.onload = function() {
    let xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if (xhr.status == 200) {
            groupviewCards = JSON.parse(xhr.responseText);
            console.log(groupviewCards[0]);

            //desktop version
            groupCardsAlls = groupviewCards[0];
            new Vue({
                el: '#groupCardsAll',
                data: {
                    groupCardsAlls,
                },
            });


            //mobile carousel
            console.log(groupviewCards);
            groupCardCarousel_1 = groupviewCards[0];
            groupCardCarousel_2 = groupviewCards[1];
            groupCardCarousel_3 = groupviewCards[2];
            groupCardCarousel_4 = groupviewCards[3];
            groupCardCarousel_5 = groupviewCards[4];

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
    xhr.open("post", "groupCard.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send();
};