/// <reference types="cypress" />

describe('Test de la page inscription', () => {
    beforeEach(() => {
        cy.visit('https://localhost:8000/inscription/compte')
    })

    it("Test affichage formulaire", () => {
        cy.get('.InscriptionBox > form > .row').should('have.length', 3)
    })
    it("Test affichage bouton", () => {
        cy.get('form > div').last().should('have.length', 1)
    })

    context('Test rentrée données', () => {
        it('Test email déjà crée', () => {
            cy.get('#creation_compte_username').type('TestCypress');
            cy.get('#creation_compte_email').type('test@test.com');
            cy.get('#creation_compte_password').type('P@ssw0rd');
            cy.get('#creation_compte_confPassword').type('P@ssw0rd');
            cy.get('input[name="birthday"]').type('1999-10-28');
            cy.get('input[name="rgpd"]').check();

            cy.contains('Demande d\'enregistrement').click()
            cy.get('.alert-danger').should('have.text', 'Un compte est déjà créé avec cette adresse mail')

        })

        it("Test password conf différent de password", () => {
            cy.get('#creation_compte_username').type('TestCypress');
            cy.get('#creation_compte_email').type('test@test.fr');
            cy.get('#creation_compte_password').type('P@ssw0rd');
            cy.get('#creation_compte_confPassword').type('P@ssw0r');
            cy.get('input[name="birthday"]').type('1999-10-28');
            cy.get('input[name="rgpd"]').check();

            cy.contains('Demande d\'enregistrement').click()
            cy.get('.alert-danger').should('have.text', 'Les mots de passes doivent êtres identiques !')
        })

        it("Test username déjà existant", () => {
            cy.get('#creation_compte_username').type('lukeCesi');
            cy.get('#creation_compte_email').type('test@test.fr');
            cy.get('#creation_compte_password').type('P@ssw0rd');
            cy.get('#creation_compte_confPassword').type('P@ssw0rd');
            cy.get('input[name="birthday"]').type('1999-10-28');
            cy.get('input[name="rgpd"]').check();

            cy.contains('Demande d\'enregistrement').click()
            cy.get('.alert-danger').should('have.text', 'Un compte est déjà créé avec ce pseudo')
        })

        it("Test données correctes", () => {
            cy.get('#creation_compte_username').type('lukeTesteAppli');
            cy.get('#creation_compte_email').type('test@test.fr');
            cy.get('#creation_compte_password').type('P@ssw0rd');
            cy.get('#creation_compte_confPassword').type('P@ssw0rd');
            cy.get('input[name="birthday"]').type('1999-10-28');
            cy.get('input[name="rgpd"]').check();

            cy.contains('Demande d\'enregistrement').click()
            cy.get('.alert-success').should('have.text', 'Votre demande a bien été prise en compte ! Veuillez la valider par mail !')
            cy.location().should((loc) => {
                expect(loc.pathname).to.eq('/')
            })
        })
    })

    context('Test Inscription + connexion au compte', () => {
        it("Test connexion après inscription", () => {
            cy.get('#creation_compte_username').type('lukeTesteAppli2');
            cy.get('#creation_compte_email').type('test@gmail.com');
            cy.get('#creation_compte_password').type('P@ssw0rd');
            cy.get('#creation_compte_confPassword').type('P@ssw0rd');
            cy.get('input[name="birthday"]').type('1999-10-28');
            cy.get('input[name="rgpd"]').check();

            cy.contains('Demande d\'enregistrement').click()
            cy.contains('Se connecter').click()
            cy.get('#inputUsername').type('lukeTesteAppli2')
                    cy.get('#inputPassword').type('P@ssw0rd')
                    cy.contains('Connexion').click()
                    cy.location().should((loc) => {
                        expect(loc.pathname).to.eq('/')
                    })
                    cy.get('.navbar > div > div > .d-flex >').should('have.length', 1)
        })
    })
})
