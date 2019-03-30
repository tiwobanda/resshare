<!DOCTYPE html>
<html>
<head>
    <base href="https://demos.telerik.com/kendo-ui/listbox/index">
    <style>html { font-size: 14px; font-family: Arial, Helvetica, sans-serif; }</style>
    <title></title>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2019.1.220/styles/kendo.common-material.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2019.1.220/styles/kendo.material.min.css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2019.1.220/styles/kendo.material.mobile.min.css" />

    <script src="https://kendo.cdn.telerik.com/2019.1.220/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2019.1.220/js/kendo.all.min.js"></script>


</head>
<body>
<div id="example" role="application">
    <div class="demo-section k-content">
        <div>
            <label for="optional" id="employees">Employees</label>
            <label for="selected">Developers</label>
            <br />
            <select id="optional" >
                <option>Steven White</option>
                <option>Nancy King</option>
                <option>Nancy Davolio</option>
                <option>Robert Davolio</option>
                <option>Michael Leverling</option>
                <option>Andrew Callahan</option>
                <option>Michael Suyama</option>
            </select>
            <select id="selected"></select>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#optional").kendoListBox({
                connectWith: "selected",
                toolbar: {
                    tools: ["moveUp", "moveDown", "transferTo", "transferFrom", "transferAllTo", "transferAllFrom", "remove"]
                }
            });

            $("#selected").kendoListBox();
        });
    </script>
</div>

<style>
    .demo-section label {
        margin-bottom: 5px;
        font-weight: bold;
        display: inline-block;
    }

    #employees {
        width: 270px;
    }

    #example .demo-section {
        max-width: none;
        width: 515px;
    }

    #example .k-listbox {
        width: 236px;
        height: 310px;
    }

    #example .k-listbox:first-of-type {
        width: 270px;
        margin-right: 1px;
    }
</style>


</body>
</html>
