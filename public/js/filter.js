/*function filter() {
    // Declare variables
    var input, filter, table, found;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    for (var i = 1, row; row = table.rows[i]; i++) {
        found=false;
        for (var j = 0, col; col = row.cells[j]; j++) {
            if (col) {
                if (strip(col.innerHTML).toUpperCase().indexOf(filter) > -1) {
                    found = true;
                }
            }
        }
        if(found){
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    }
}
function strip(html)
{
    var tmp = document.createElement("DIV");
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || "";
}