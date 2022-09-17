import React, { Component } from 'react';
import {Link} from "react-router-dom";

class Header extends Component {
    render() {
        return (
            <header className="site-navbar site-navbar-target" role="banner">
                <div className="container">
                    <div className="row align-items-center position-relative">
                        <div className="col-3">
                            <div className="site-logo">
                            <Link to="/" className="font-weight-bold">BRAND</Link>
                            </div>
                        </div>

                        <div className="col-9  text-right">
                            <span className="d-inline-block d-lg-none">
                                <Link to="/" className="text-primary site-menu-toggle js-menu-toggle py-5">
                                    <span className="icon-menu h3 text-white">
                                    </span>
                                </Link>
                            </span>
                            <nav className="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                            <ul className="site-menu main-menu js-clone-nav ml-auto ">
                                <li><Link to="/cadastrotipo" className="nav-link">Cadastro Tipo</Link></li>
                                <li><Link to="/cadastroproduto" className="nav-link">Cadastro de Produto</Link></li>
                                <li><Link to="/cadastrovenda" className="nav-link">Cadastro de Venda</Link></li>
                            </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>
        );
    }
}

export default Header;