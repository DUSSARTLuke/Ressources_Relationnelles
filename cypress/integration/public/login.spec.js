/// <reference types="cypress" />

describe('Test de la page login', () => {
    beforeEach(() => {
        cy.visit('https://localhost:8000/login')
    })

    it("Test affichage input", () => {
        cy.get('.InscriptionBox > .row >').should('have.length', 2)
    })
    it("Test affichage bouton", () => {
        cy.get('form > .container > .d-flex >').should('have.length', 2)
    })


    context('Test rentrée données', () => {
        it('Test mauvaise donnée', () => {
            cy.get('#inputUsername').type('test')
            cy.get('#inputPassword').type('test')
            cy.contains('Connexion').click()
            cy.get('.alert-danger').should('have.text', 'Invalid credentials.')
        })
        it('Test bonne donnée', () => {
            cy.get('#inputUsername').type('lukeCesi')
            cy.get('#inputPassword').type('test')
            cy.contains('Connexion').click()
            cy.location().should((loc) => {
                expect(loc.pathname).to.eq('/')
            })
            cy.get('.navbar > div > div > .d-flex >').should('have.length', 1)
        })
    })

    context('Test accueil connectée', () => {
        beforeEach(() => {
            cy.get('#inputUsername').type('lukeCesi')
            cy.get('#inputPassword').type('test')
            cy.contains('Connexion').click()
            cy.location().should((loc) => {
                expect(loc.pathname).to.eq('/')
            })
            cy.get('.navbar > div > div > .d-flex >').should('have.length', 1)
        })
        it('Test déconnexion', () => {
            cy.contains('Profil').click();
            cy.contains('Déconnexion').click();
            cy.get('.navbar > div > div > .d-flex >').should('have.length', 2)
        })
        it('Test bouton ressources', () => {

        })
    })
})