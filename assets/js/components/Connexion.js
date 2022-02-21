import React, {Component} from 'react';
import {Link} from "react-router-dom";
import Inscription from "./Inscription";
import axios from "axios";

export default function Connexion() {

    function handleSubmit(event) {
        event.preventDefault();
        if (state.password === state.conf_password) {

            // console.log(state.donnees);
            axios.post(`https://localhost:8000/api/users`, {
                'username': state.username,
                'password': state.password,
                'email': state.email,
                'isRGPD': state.donnees,
                'birthday': new Date(state.birthday),
            })
                .then(res => {
                    window.location.href = "https://localhost:8000/app/connexion";
                })

        } else {
            alert('Vos mots de passe ne correspondent pas ! Veuillez les ressaissir')
        }
    }

    return (
        <div className="container">
            <form onSubmit={handleSubmit}>
                <div className="form-group">
                    <h2 className="form-label mt-4 text-center">Se connecter</h2>
                    <div className="row mb-5">
                        <div className="form-floating col-lg-6">
                            <input type="email" className="form-control" id="input-email"
                                   placeholder="Votre adresse mail"/>
                            <label htmlFor="input-email">Adresse mail</label>
                        </div>
                        <div className="form-floating col-lg-6">
                            <input type="password" className="form-control" id="input-pwd"
                                   placeholder="Mot de passe"/>
                            <label htmlFor="input-pwd">Mot de passe</label>
                        </div>
                    </div>
                </div>
                <div className="text-center">
                    <button className="btn btn-lg btn-primary">Se connecter</button>
                </div>
            </form>
            <Link className="text-center" to="/app/inscription" element={<Inscription/>}>Non Inscrit? Rejoignez-nous
                ! </Link>
        </div>
    );

}