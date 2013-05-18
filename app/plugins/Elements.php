<?php

class Elements extends Phalcon\Mvc\User\Component
{
    public function getLogin()
    {
        $auth = $this->session->get('auth');
        if ($auth) {
            $user = $this->getDI()->get('user');
            ?>
            <ul class="right">
                <li class="has-dropdown"><a><?php echo $user->email ?></a>
                    <ul class="dropdown">
                        <li class=""><a href="/one/logout">Выход</a></li>
                    </ul>
                </li>
            </ul>
        <?php
        } else {
            ?>
            <ul class="right">
                <li class="divider hide-for-small"></li>
                <li class=""><a href="#" data-reveal-id="loginModal">Вход для партнеров</a></li>
            </ul>
        <?php
        }
    }

    public function getShopMenu()
    {
        $categoryModel = new \Shop\Category();
        $categoryList = $categoryModel->find();
        foreach ($categoryList as $category) {
            ?>
            <li><a href="/shop/index/?category=<?php echo $category->id ?>"><?php echo $category->name ?></a></li>
            <li class="divider"></li>
        <?php
        }
        ?>
        <li><a href="/shop/index">Все</a></li>
        <li class="divider"></li>
    <?php
    }
}