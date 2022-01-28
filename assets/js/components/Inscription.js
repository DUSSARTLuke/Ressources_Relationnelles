import React from "react";
import axios from 'axios';
import {format} from 'date-fns';
import "react-datetime/css/react-datetime.css";
import {Link} from "react-router-dom";


export default function Inscription() {
    const [state, setState] = React.useState({
        username: "",
        email: "",
        password: "",
        birthday: "",
        donnees: false,
        conf_password: ''
    })

    function handleChange(evt) {
        const value =
            evt.target.type === "checkbox" ? evt.target.checked : evt.target.value;
        setState({
            ...state,
            [evt.target.name]: value
        });
    }

    function handleSubmit(event) {
        event.preventDefault();
        if (state.password === state.conf_password) {

            console.log(state.donnees);
            axios.post(`https://localhost:8000/api/users`, {
                'username': state.username,
                'password': state.password,
                'email': state.email,
                'isRGPD': state.donnees,
                'birthday': new Date(state.birthday),
            })
                .then(res => {
                    window.location.href('https://localhost:8000/app/');
                })

        } else {
            alert('Vos mots de passe ne correspondent pas ! Veuillez les ressaissir')
        }
    }


    return (
        <div className="container">
            <form onSubmit={handleSubmit}>
                <div className="form-group">
                    <h2 className="form-label mt-4 text-center">S'inscrire</h2>
                    <div className="row mb-5">
                        <div className="form-floating col-lg-6">
                            <input type="text" className="form-control" name="username" value={state.username}
                                   onChange={handleChange} placeholder="Pseudo"/>
                            <label htmlFor="username">Pseudo</label>
                        </div>
                        <div className="form-floating col-lg-6">
                            <input type="email" className="form-control" name="email" value={state.email}
                                   onChange={handleChange} placeholder="Adresse mail"/>
                            <label htmlFor="email">Adresse mail</label>
                        </div>
                    </div>
                    <div className="row mb-5">
                        <div className="form-floating col-lg-6">
                            <input type="password" className="form-control" name="password" value={state.password}
                                   onChange={handleChange} placeholder="Mot de passe"/>
                            <label htmlFor="password">Mot de passe</label>
                        </div>
                        <div className="form-floating col-lg-6">
                            <input type="password" className="form-control" name="conf_password"
                                   value={state.conf_password}
                                   onChange={handleChange} placeholder="Confirmer votre mot de passe"/>
                            <label htmlFor="conf_password">Confirmation du mot de passe</label>
                        </div>
                    </div>
                    <div className="row mb-5">
                        <div className="form-floating col-lg-6">
                            <input type="date" className="form-control" name="birthday" value={state.birthday}
                                   onChange={handleChange} placeholder="Pseudo"/>
                            <label htmlFor="name">Pseudo</label>
                        </div>
                        <div className="form-check col-lg-6">
                            <input className="form-check-input" type="checkbox" value={state.donnees}
                                   onChange={handleChange} name="donnees"/>
                            <label className="form-check-label" htmlFor="donnees">
                                Je consens à ce que mes données personnelles soient traitées pour que le ministère des
                                solidarités et de la santé puisse effectuer des statistiques.
                            </label>
                        </div>
                    </div>
                </div>
                <div className="text-center">
                    <button type={"submit"} className={"btn btn-lg btn-success"}>S'inscrire</button>
                </div>
            </form>
        </div>
    )
        ;
}