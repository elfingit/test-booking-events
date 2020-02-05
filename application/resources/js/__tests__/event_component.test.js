import {shallowMount} from "@vue/test-utils"
import EventComponent from "../components/EventComponent"
import axios from "axios"
const MockAdapter = require("axios-mock-adapter")
import flushPromises from 'flush-promises'

describe('EventComponent', () => {

    let mock

    afterAll(() => {
        mock.restore()
    })

    beforeEach(() => {
        mock = new MockAdapter(axios)
    })

    test('load event', async () => {
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
})
