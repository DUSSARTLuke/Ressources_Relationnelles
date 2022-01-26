import React, {Component} from 'react';
import {BrowserRouter as Router, Routes, Route, Link} from "react-router-dom";
import Users from './Users';
import Home from './home';

class Navbar extends Component {

    render() {
        return (
            <Router>
                <main>
                    <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
                        <Link className={"navbar-brand"} to={"/"}> Symfony React Project </Link>
                        <div className="collapse navbar-collapse" id="navbarText">
                            <ul className="navbar-nav mr-auto">
                                <li className="nav-item">
                                    <Link className={"nav-link"} to={"/"}> Home </Link>
                                </li>

                                <li className="nav-item">
                                    <Link className={"nav-link"} to={"/users"}> Users </Link>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <Routes>
                        <Route path="/" exact component={<Home />} />
                        <Route path="/users" component={<Users />} />
                    </Routes>
                </main>
            </Router>)
    }
}

export default Navbar;
