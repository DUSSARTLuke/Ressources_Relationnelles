import React from 'react';
import {Routes, Route, Link} from "react-router-dom";
import Home from "./Home";
import Connexion from "./Connexion";
import Inscription from "./Inscription";

export default class Navbar extends Component {

    render() {
        return (
            <main>
                <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div className="container-fluid">
                        <Link className={"navbar-brand"} to={"/app/"}> Symfony React Project </Link>
                        <button className="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span className="navbar-toggler-icon"></span>
                        </button>

                        <div className="collapse navbar-collapse" id="navbarColor02">
                            <ul className="navbar-nav me-auto">
                                <li className="nav-item">
                                    <Link className={"nav-link active"} to={"/app/"}> Accueil </Link>
                                </li>
                            </ul>
                            <div className="d-flex">
                                <Link className="btn btn-primary" to="/app/connexion"> Se connecter</Link>
                            </div>
                        </div>
                    </div>
                </nav>
                <Routes>
                    <Route path="/app/" element={<Home/>}/>
                    <Route path="/app/connexion" element={<Connexion/>}/>
                    <Route path="/app/inscription" element={<Inscription/>}/>
                </Routes>
            </main>)
    }
}