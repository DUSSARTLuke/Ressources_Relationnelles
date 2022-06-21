/// <reference types="cypress" />

describe('Test de la page inscription', () => {
    beforeEach(() => {
        cy.visit('https://localhost:8000/inscription/compte')
    })

    it("Test affichage formulaire", () => {
        cy.get('.InscriptionBox > form > .row').should('have.length', 3)
    })
    it("Test affichage bouton", () => {
        cy.get('.InscriptionBox > form > .mt-5 >').should('have.length', 1)
    })

})
