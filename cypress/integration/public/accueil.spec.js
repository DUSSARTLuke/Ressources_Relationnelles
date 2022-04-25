/// <reference types="cypress" />

describe('Test de la page d\'accueil', () => {
    beforeEach(() => {
        cy.visit('https://localhost:8000/')
    })

    it("Test affichage navbar", () => {
        cy.get('.navbar > div >').should('have.length', 3)
        cy.get('.nav-item > .active').first().should('have.text', 'Accueil')
        cy.get('.navbar > div > div > div > .btn-res').should('have.length', 2)
    })

    context('Test affichage card', () => {
        it('Toutes les cards', () => {
            cy.get('.card-res').should('have.length', 6)
        })
        it('filtrage Tag card', () => {
            cy.get('.tag').eq(1).click()
            cy.get('.card-res').eq(2).should('have.class', 'd-none')
        })
        it('filtrage Texte card', () => {
            cy.get('.input-search').type('res')
            cy.get('.card-res').eq(5).should('have.class', 'd-none')
        })
        it('filtrage Type Relation card', () => {
            // cy.get('.card-res').eq(2).should('have.class', 'd-none')
        })
        it('filtrage Type Ressource card', () => {
            // cy.get('.card-res').eq(2).should('have.class', 'd-none')
        })
    })

    context('Test click sur bouton ', () => {
        it('Click sur bouton se connecter', () => {
            cy.get('.navbar > div > div > div > .btn-res').eq(0).click()
            cy.get('#loginH1').first().should('have.text', 'Veuillez vous connecter')
        })
        it("Click sur bouton S'inscrire", () => {
            cy.get('.navbar > div > div > div > .btn-res').eq(1).click()
            cy.get('h2').first().should('have.text', ' Remplissez ce formulaire afin de vous créer un compte ! ')
        })
    })
})
