<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
<svg class="barcode"
  jsbarcode-format="upc"
  jsbarcode-value="123456789012"
  jsbarcode-textmargin="0"
  jsbarcode-fontoptions="bold">
</svg>
<script>
  
  JsBarcode(".barcode").init();
</script>