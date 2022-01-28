import React, {Component} from 'react';
import {Link} from "react-router-dom";
import Inscription from "./Inscription";

export default class Connexion extends Component {
    constructor(props) {
        super(props)
        this.handleSubmit = this.handleSubmit.bind(this);
    };

    handleSubmit() {
        fetch('https://localhost/api/user', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.status >= 200 && response.status < 300) {
                return response;
                console.log(response);
                window.location.reload();
            } else {
                console.log('Somthing happened wrong');
            }
        }).catch(err => err);
        const text = {
            news_title: this.state.title,
            news_description: this.state.desc,
            news_type: this.state.type,
            news_src_url: this.state.imageurl,
            operation:"insert"
        }

    };

    render() {
        return (
            <div className="container">
                <form action="" method="post">
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
                <Link className="text-center" to="/app/inscription" element={<Inscription />}>Non Inscrit? Rejoignez-nous ! </Link>
            </div>
        );
    }
}