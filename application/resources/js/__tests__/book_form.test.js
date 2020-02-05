import {shallowMount} from "@vue/test-utils"
import BookFormComponent from "../components/BookFormComponent"
import axios from "axios"
import flushPromises from 'flush-promises'

const MockAdapter = require("axios-mock-adapter")
require('jsdom-global')
require('materialize-css')

window._ = require('lodash')

describe('BookFormComponent', () => {
    let mock

    afterEach(() => {
        mock.reset()
    })

    beforeEach(() => {
        mock = new MockAdapter(axios)
    })

    test('Component correctly render', () => {

        const wrapper = shallowMount(BookFormComponent)

        expect(wrapper.find('input[id=company_name]').exists()).toBeTruthy()
        expect(wrapper.find('input[id=contact_name]').exists()).toBeTruthy()
        expect(wrapper.find('input[id=email]').exists()).toBeTruthy()
        expect(wrapper.find('input[id=phone]').exists()).toBeTruthy()
        expect(wrapper.find('textarea[id=description]').exists()).toBeTruthy()
        expect(wrapper.find('input[id=file]').exists()).toBeTruthy()

    })

    test('Erros render correctly', async () => {

        mock
            .onPost('/api/reserve_place')
            .reply(422, {
                errors: {
                    company_name: ['Company name error'],
                    contact_name: ['Contact name error'],
                    email: ['Email error'],
                    phone: ['Phone error'],
                    description: ['Description error'],
                    logo_file: ['File error']
                }
            })

        const wrapper = shallowMount(BookFormComponent)

        wrapper.vm.show({
            price: 18.14
        })

        wrapper.find('button.waves-effect').trigger('click')

        await flushPromises()

        const fieldContainers = wrapper.findAll('div.input-field')

        expect(
            fieldContainers.at(0)
            .find('span.helper-text')
            .attributes('data-error')
        ).toBe('Company name error')

        expect(
            fieldContainers.at(1)
                .find('span.helper-text')
                .attributes('data-error')
        ).toBe('Contact name error')

        expect(
            fieldContainers.at(2)
                .find('span.helper-text')
                .attributes('data-error')
        ).toBe('Email error')

        expect(
            fieldContainers.at(3)
                .find('span.helper-text')
                .attributes('data-error')
        ).toBe('Phone error')

        expect(
            fieldContainers.at(4)
                .find('span.helper-text')
                .attributes('data-error')
        ).toBe('Description error')

        expect(
            fieldContainers.at(5)
                .find('span.helper-text')
                .attributes('data-error')
        ).toBe('File error')

    })

    test('Event "newReservation" happen', async () => {
        mock
            .onPost('/api/reserve_place')
            .reply(200, {
                data: {
                    id: 1001,
                    place_id: 1001,
                    logo: 'http://localhost/storage/images/event_logos/1/AQrdnB3S.png'
                }
            })

        const wrapper = shallowMount(BookFormComponent)

        wrapper.vm.show({
            price: 18.14
        })

        wrapper.find('button.waves-effect').trigger('click')

        await flushPromises()

        expect(wrapper.emitted().newReservation).toEqual(
            [[{
                id: 1001,
                place_id: 1001,
                logo: 'http://localhost/storage/images/event_logos/1/AQrdnB3S.png'
            }]]
        )

    })
})
