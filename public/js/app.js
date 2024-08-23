if($(".assign_lot_form").length)
{
    let assignLot = {
        selectedLot: null,

        init: function() {
            $("body").on("change", ".assign_lot_form #lot_id", this.handleLotChange);
            $("body").on("keyup", "input", this.handleInputChange);
            console.log(this.selectedLot);
        },

        handleLotChange: function() {
            let selectLot = $("body").find(".assign_lot_form #lot_id").val();
            let url = $("body").find(".assign_lot_form #lot_id").data("url");

            $.ajax({
                url: url+"/"+selectLot,
                success: function(resp) {
                    if(resp.status) {
                        assignLot.selectedLot = resp.data;
                        totalAssignPcs = 0;
                        assignLot.selectedLot.worker.forEach((item, index) => {
                            let assignTableData = "<tr>";
                            assignTableData += `<td>${index+1}</td><td>${item.first_name} ${item.last_name ?? ""}</td><td>${item.assign_pcs}</td>`;
                            totalAssignPcs += item.assign_pcs;
                            assignTableData += "</td>";
                            $("body").find("#lot_data table").append(assignTableData);
                        })
                        $("body").find("#lot_data").show();
                        $("body").find("#assign_pcs").attr("min", assignLot.selectedLot.pcs - totalAssignPcs)
                    }
                }
            });
        },
        
        handleInputChange: function() {
            let that = $(this);
            console.log(that.attr("min"));
            that.siblings("span.text-danger").text("");
            if(that.attr("min")) {
                if(parseInt(that.val()) > parseInt(that.attr("min"))) {
                    that.siblings("span.text-danger").text(`Value should not be more that ${that.attr("min")}`);
                }
            }
        }
    }

    assignLot.init();
}
