if($(".assign_lot_form").length)
{
    let assignLot = {
        selectedLot: null,
        remainingPcs: null,

        init: function() {
            $("body").on("change", ".assign_lot_form #lot_id", this.handleLotChange);
            $("body").on("keyup", "input", this.handleInputChange);
            $("body").on("click", ".delete_assign_worker", this.handleDeleteAssign);
            $("body").on("keyup", "table .assign_pcs", this.handleEditAssignPcs);
            $("body").on("click", ".add_all_btn", this.handleAddAll);
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
                        $("body").find("#lot_data table tbody").empty();
                        assignLot.selectedLot.worker.forEach((item, index) => {
                            let assignTableData = "<tr>";
                            assignTableData += `<td>${index+1}</td><td>${item.first_name} ${item.last_name ?? ""}</td><td>${item.assign_pcs}</td>`;
                            totalAssignPcs += item.assign_pcs;
                            assignTableData += "</td>";
                            $("body").find("#lot_data table tbody").append(assignTableData);
                        })
                        $("body").find("#lot_data").show();
                        $("body").find("#assign_pcs").val("");
                        $("body").find(".add_all_btn").removeClass("disabled");
                        assignLot.remainingPcs = assignLot.selectedLot.pcs - totalAssignPcs;
                        $("body").find("#assign_pcs").attr("min", assignLot.remainingPcs);
                    }
                }
            });
        },
        
        handleInputChange: function() {
            let that = $(this);
            $("body").find("button").removeClass("disabled");
            that.siblings("span.text-danger").text("");
            if(that.attr("min")) {
                if(parseInt(that.val()) > parseInt(that.attr("min"))) {
                    $("body").find("button").addClass("disabled");
                    that.siblings("span.text-danger").text(`Value should not be more that ${that.attr("min")}`);
                }
            }
        },

        handleDeleteAssign: function() {
            let that = $(this);
            if(confirm("Do you want to remove assign worker lot?"))
            {
                that.closest("tr").remove();
            }
        },

        handleEditAssignPcs: function() {
            that = $(this);
            $("body").find(".form_error").text("");
            $("body").find("button").removeClass("disabled");
            assignLot.selectedLot = $("body").find("#lot_data").data("lot-data");
            let allPcsInput = $("body").find("table .assign_pcs");
            let totalAssignPcs = $.makeArray(allPcsInput).reduce((a, b) => a + parseInt(b.value), 0);
            if(totalAssignPcs > assignLot.selectedLot.pcs) {
                $("body").find(".form_error").text("Assign total pcs should not be more than lot pcs.");
                $("body").find("button").addClass("disabled");
            }
        },

        handleAddAll: function() {
            $("body").find("#assign_pcs").val(assignLot.remainingPcs > 0 ? assignLot.remainingPcs : "");
        }
    }

    assignLot.init();
}
