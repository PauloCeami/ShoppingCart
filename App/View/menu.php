<header>
    <!-- Sub Navigation -->
    <div class="top-bar">

        <div class="top-bar-left">
            <ul class="menu">
                <li><a href="<?= BASE_URL ?>">Shopping PreCode</a></li>
                <li><a href="<?= BASE_URL ?>">Loja de Produtos</a></li>
            </ul>
        </div>

        <div class="top-bar-right">
            <ul class="menu vertical medium-horizontal expanded medium-text-left" data-responsive-menu="drilldown medium-dropdown">
                <li class="has-submenu" id="CartAll">
                    <a href="#" id="countCart">Carrinho(0)</a>
                    <ul class="submenu menu vertical" data-submenu>
                        <table>
                            <thead>
                                <tr>
                                    <th>foto</th>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
<!--                                    <th>Valor</th>-->
                                    <th>SubTotal</th>
                                    <th>*</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td colspan="5">Carrinho vazio</td></tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Total:</td>
                                    <td colspan="5" id="totalCart">R$ 0,00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </ul>
                </li>
                <li><a href="#">Serviços</a></li>
                <li><a href="#">Contato</a></li>
                <li><a href="#">Atendimento</a></li>
                <li><a href="#">Login</a></li>
            </ul>
        </div>
    </div>

    <div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
        <button class="menu-icon" type="button" data-toggle></button>
        <div class="title-bar-title">Menu</div>
    </div>


</header>