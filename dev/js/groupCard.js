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
                computed: {
                    sortbyLike() {
                        return this.groupCardsAlls.sort((a, b) => a.hostlike - b.hostlike);
                    }
                }
            });

        } else {
            alert(xhr.status);
        }
    };
    xhr.open("post", "groupCard.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send();
};