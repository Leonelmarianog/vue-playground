import Card from "./Card.js";

const List = {
    components: { Card },
    template: `
        <div class="bg-neutral-300 rounded-md shadow-sm">
             <div class="px-4 py-2">
                 <h2 class="font-bold capitalize">{{ title }}</h2>
             </div>
    
             <div class="px-2 pb-2 space-y-4">
                 <ul class="space-y-2">
                     <li v-for="card in cards">
                        <Card :content="card.content" :labels="card.labels" />
                     </li>    
                 </ul>
    
                 <button class="font-bold text-sm text-neutral-500 cursor-pointer hover:text-neutral-700">+
                     Add another card
                 </button>
             </div>
        </div>
    `,

    props: {
        title: String,
        cards: Array
    }
}

export default List;
