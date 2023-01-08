"use strict";
var chats = [];
fetch("/dashboard-company", {
    method: "GET",
    headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
    },
})
    .then((response) => response.json())
    .then((data) => {
        let p = data.qna;
        for (const key in p) {
            const element = p[key];
            element.text = element.message;
            if (element.type == "answer") {
                element.position = "right";
            } else if (element.type == "question") {
                element.position = "left";
            }
            delete element.message;
            delete element.type;
            chats.push(element);
        }
        console.log(chats);

        for (var i = 0; i < chats.length; i++) {
            var type = "text";
            if (chats[i].typing != undefined) type = "typing";
            $.chatCtrl("#mychatbox", {
                text: chats[i].text != undefined ? chats[i].text : "",
                picture:
                    chats[i].position == "left"
                        ? "/img/avatar/avatar-1.png"
                        : "/img/avatar/avatar-2.png",
                position: "chat-" + chats[i].position,
                type: type,
            });
        }

        $("#chat-form").submit(function () {
            var me = $(this);

            if (me.find("input").val().trim().length > 0) {
                $.chatCtrl("#mychatbox", {
                    text: me.find("input").val(),
                    picture: "/img/avatar/avatar-2.png",
                });
                me.find("input").val("");
            }
            return false;
        });
    })
    .catch((error) => {
        console.error("Error:", error);
    });
