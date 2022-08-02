<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
<svg class="barcode"
  jsbarcode-format="upc"
  jsbarcode-value="123456789012"
  jsbarcode-textmargin="0"
  jsbarcode-fontoptions="bold">
</svg>
<script>
  
  JsBarcode(".barcode").init();
var myArray = [{id:1, name:'Morty'},{id:2, name:'Rick'},{id:3, name:'Anna'}];
var newArray = myArray.filter((item) => item.id !== 1);
console.log(newArray);
</script>