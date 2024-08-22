if($(".assign_lot_form").length)
{
    let assignLot = {
        init: function() {
            $("body").on("change", ".assign_lot_form #lot_id", assignLot.handleLotChange);
        },

        handleLotChange: function() {
            let selectLot = $("body").find(".assign_lot_form #lot_id").val();
            let url = $("body").find(".assign_lot_form #lot_id").data("url");

            $.ajax({
                url: url+"/"+selectLot,
                success: function(resp) {
                    console.log(resp);
                }
            });
        }
    }

    assignLot.init();
}
