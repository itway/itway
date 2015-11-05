var initLikeORdis = function (buttonID, base_url, class_name, object_id, redirectIFerror) {
        if (buttonID.length !== 0) {

                buttonID.submit(function (e) {
                    e.preventDefault();
                    var button = $(this).find("button"),
                        buttonI = $(this).find("button i");

                    $.ajax({
                        type: "GET",
                        url: base_url,
                        data: {'class_name': class_name, 'object_id': object_id},
                        success: function (data) {

                            if (data === "error") {
                                window.location.href = redirectIFerror;
                            }
                            if (data[0] === "liked") {

                                buttonI.addClass('text-danger');
                                buttonI.removeClass('icon-favorite_outline');
                                buttonI.addClass('icon-favorite');
                                button.tooltipster('content', data[1]);
                                buttonID.parent().append($("<span/>", {
                                    "text": data[2],
                                    "class": "like-message"
                                }));
                            $("span .like-message").animate({
                                    opacity: 0.25,
                                    left: "+=50",
                                    height: "toggle"}, 200);
                            }
                            else {

                                buttonI.removeClass('text-danger');
                                buttonI.addClass('icon-favorite_outline');
                                buttonI.removeClass('icon-favorite');
                                button.tooltipster('content', data[1]);
                                buttonID.parent().find(".like-message").remove();
                            }

                        },
                        error: function (data) {
                            console.log("error" + "   " + data);
                        }
                    }, "html");

                });

        }
    };