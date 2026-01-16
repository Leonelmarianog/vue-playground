import lists from '../../data/db.js';
import List from "./List.js";
import Layout from "./Layout.js";

const App = {
    components: {
        Layout, List,
    },

    template: `
        <Layout>
            <template v-slot:heading>
                <h1 class="font-bold text-3xl text-center">My board</h1>
            </template>
        
            <template v-slot:default>
                <div id="board" class="grid auto-cols-[20em] grid-flow-col gap-2 items-start h-full">
                    <List v-for="list in lists" :id="list.id" :title="list.title" :cards="list.cards" @create-card="handleCreateCard"/>
                    
                    <button class="bg-black/20 py-4 rounded-md shadow-sm cursor-pointer hover:bg-black/10 font-bold text-sm text-black">
                        + Add another list
                    </button>
                </div>
            </template>
        </Layout>
    `,

    data( ) {
        return {
            lists
        }
    },

    methods: {
        handleCreateCard(formData) {
            const list = this.lists.find((list) => list.id === formData.listId);

            list.cards.push({
                id: new Date().getTime(),
                content: formData.content,
                labels: []
            });
        }
    }
}

export default App;