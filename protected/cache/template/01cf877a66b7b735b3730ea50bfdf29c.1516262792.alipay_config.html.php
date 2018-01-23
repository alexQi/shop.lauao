<?php if(!class_exists("View", false)) exit("no direct access allowed");?><tr>
  <th>配置参数</th>
  <td><input type="hidden" name="pcode" value="alipay" />
    <table class="dataform">
      <tr>
        <th width="110">支付宝账号</th>
        <td><input class="w300 txt" name="params[seller]" id="seller_id" type="text" value="<?php echo htmlspecialchars($rs['params']['seller'], ENT_QUOTES, "UTF-8"); ?>" /></td>
      </tr>
      <tr>
        <th>合作者身份(PID)</th>
        <td><input class="w300 txt" name="params[partner]" id="partner" type="text" value="<?php echo htmlspecialchars($rs['params']['partner'], ENT_QUOTES, "UTF-8"); ?>" /></td>
      </tr>
      <tr>
        <th>安全检验码 (KEY)</th>
        <td><input class="w300 txt" name="params[key]" id="key" type="text" value="<?php echo htmlspecialchars($rs['params']['key'], ENT_QUOTES, "UTF-8"); ?>" /></td>
      </tr>
    </table>
  </td>
</tr>