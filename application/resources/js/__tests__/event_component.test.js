import {shallowMount, mount} from "@vue/test-utils"
import EventComponent from "../components/EventComponent"
import axios from "axios"
const MockAdapter = require("axios-mock-adapter")
import flushPromises from 'flush-promises'

describe('EventComponent', () => {

    let mock

    afterEach(() => {
        mock.reset()
    })

    beforeEach(() => {
        mock = new MockAdapter(axios)
    })

    test('Is loaded event rendered correctly', async () => {
        mock
            .onGet('/api/events/1001')
            .reply(200, {
                data: {
                    title: 'Test event',
                    description: 'test event descr',
                    started_at: '12-02-2020',
                    end_at: '17-02-2020'
                }
            })

        mock
            .onGet('/api/events/1001/place')
            .reply(200, {
                data: []
            })

        const wrapper = shallowMount(EventComponent, {
            propsData: {
                id: 1001
            },
            stubs: ['router-link']
        })

        await flushPromises()

        const title = wrapper.find('h3')
        expect(title.text()).toBe('Test event')

        const descr = wrapper.find('div.col p')
        expect(descr.text()).toBe('test event descr')

        const startTime = wrapper.findAll('span.time').at(0)
        const endTime = wrapper.findAll('span.time').at(1)
        expect(startTime.text()).toBe('Start at: 12-02-2020')
        expect(endTime.text()).toBe('End at: 17-02-2020')

    })

    test('Is loaded places rendered', async () => {
        mock
            .onGet('/api/events/1001')
            .reply(200, {
                data: {
                    title: 'Test event',
                    description: 'test event descr',
                    started_at: '12-02-2020',
                    end_at: '17-02-2020'
                }
            })

        mock
            .onGet('/api/events/1001/place')
            .reply(200, {
                data: [
                    {
                       id: 1001,
                       price: 14.95,
                       position_x: 0,
                       position_y: 0,
                       reservation: null
                    },
                    {
                        id: 1002,
                        price: 15.00,
                        position_x: 80,
                        position_y: 0,
                        reservation: null
                    }
                ]
            })

        const wrapper = mount(EventComponent, {
            propsData: {
                id: 1001
            },
            stubs: ['router-link', 'BookFormComponent']
        })

        await flushPromises()

        const places = wrapper.findAll('div.place-container')

        expect(places.length).toBe(2)
    })
})
