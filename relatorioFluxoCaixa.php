<table width="95%" border="0">
      
      <tr>
        <th height="21" colspan="2">&nbsp;</th>
      </tr>
      <tr bgcolor="#000033">
        <th height="50" colspan="2" bgcolor="#000033" class="RelatorioTitle">Entrada</th>
      </tr>
      <tr>
        <th width="62%" class="RelatorioField">Receita de vendas</th>
        <th width="38%" bgcolor="#FFC" class="RelatorioValue">
        <?php 
            printf("%s",$GLOBALS['Fluxo de caixa']['Receita de vendas']); 
        ?>
        </th>
      </tr>
      <tr>
        <th class="RelatorioField">Aplicações    financeiras</th>
        <th bgcolor="#FFC" class="RelatorioValue">
        <?php printf("%s",$GLOBALS['Fluxo de caixa']['Aplicacoes financeiras']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Venda de    máquinas</th>
        <th bgcolor="#FFC" class="RelatorioValue">
        <?php printf("%s",$GLOBALS['Fluxo de caixa']['Venda de maquinas']); ?></th>
      </tr>


      <tr>
        <th class="RelatorioField">Vendas à  prazo</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s",$GLOBALS['Fluxo de caixa']['Vendas a prazo']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Empréstimo    de longo prazo</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s",$GLOBALS['Fluxo de caixa']['Emprestimo de longo prazo']); ?></th>
      </tr>
      <tr>
        <th colspan="2">&nbsp;</th>
      </tr>
      <tr bgcolor="#000033">
        <th height="50" colspan="2" bgcolor="#000033" class="RelatorioTitle">Despesas</th>
      </tr>
      <tr>
        <th class="RelatorioField">Compra    de matéria prima</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Compra de materia prima']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Compra    de máquinas</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Compra de maquinas']); ?></th>
      </tr>


      <tr>
        <th class="RelatorioField">Operação    de máquinas</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Operacao de maquinas']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Manutenção</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Manutencao']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Salários dos operários</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Salario de operarios']); ?></th>
      </tr>

      <tr>
        <th class="RelatorioField">Salários    administrativos</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Salarios administrativos']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Contratação</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Contratacao']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Demissão</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Demissao']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Propaganda</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Propaganda']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">P&amp;D</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['P&D']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Comissões</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Comissoes']); ?></th>
      </tr>


      <tr>
        <th class="RelatorioField">Estoque</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Estoque']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Juros    sobre emprestimos</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Juros sobre emprestimos']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Gastos    gerais</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Gastos gerais']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Parcelas    dos emprestimos</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Parcelas dos emprestimos']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Impostos    totais sobre a venda</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Impostos totais sobre vendas']); ?></th>
      </tr>
      <tr>
        <th colspan="2">&nbsp;</th>
      </tr>

      <tr>
        <th class="RelatorioField">Variação    do caixa</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Variacao do caixa']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Caixa    inicial</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Caixa inicial']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Caixa    final</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Caixa final']); ?></th>
      </tr>
      <tr>
        <th colspan="2">&nbsp;</th>
      </tr>
      <tr>
        <th class="RelatorioField">Movimentação    de caixa</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Fluxo de caixa']['Movimentacao de caixa']); ?></th>
      </tr>
     
    </table>
