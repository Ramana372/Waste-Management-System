// API Base URL
const API_BASE_URL = 'http://localhost:8000/api';

// Utility Functions
const formatDate = (date) => new Date(date).toLocaleString();
const showError = (message) => alert(message); // Replace with better error handling

// Navigation
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const targetSection = e.target.getAttribute('data-section');
        document.querySelectorAll('.section-content').forEach(section => {
            section.classList.add('d-none');
        });
        document.getElementById(targetSection).classList.remove('d-none');
    });
});

// Collection Management
const collectionForm = document.getElementById('collection-form');
const collectionsTable = document.getElementById('collections-table').querySelector('tbody');

async function loadCollections() {
    try {
        const response = await fetch(`${API_BASE_URL}/collections`);
        const collections = await response.json();
        collectionsTable.innerHTML = collections.map(collection => `
            <tr>
                <td>${formatDate(collection.date)}</td>
                <td>${collection.location.name}</td>
                <td>${collection.wasteCategory.name}</td>
                <td>${collection.quantity} kg</td>
                <td><span class="badge badge-${collection.status.toLowerCase()}">${collection.status}</span></td>
            </tr>
        `).join('');
    } catch (error) {
        showError('Failed to load collections');
    }
}

async function loadLocations() {
    try {
        const response = await fetch(`${API_BASE_URL}/locations`);
        const locations = await response.json();
        const select = document.getElementById('collection-location');
        select.innerHTML = locations.map(location =>
            `<option value="${location.id}">${location.name}</option>`
        ).join('');
    } catch (error) {
        showError('Failed to load locations');
    }
}

async function loadCategories() {
    try {
        const response = await fetch(`${API_BASE_URL}/waste-categories`);
        const categories = await response.json();
        const select = document.getElementById('collection-category');
        select.innerHTML = categories.map(category =>
            `<option value="${category.id}">${category.name}</option>`
        ).join('');
    } catch (error) {
        showError('Failed to load categories');
    }
}

collectionForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = {
        location_id: document.getElementById('collection-location').value,
        waste_category_id: document.getElementById('collection-category').value,
        quantity: document.getElementById('collection-quantity').value,
        collector_notes: document.getElementById('collection-notes').value,
        date: new Date().toISOString(),
        status: 'PENDING'
    };

    try {
        const response = await fetch(`${API_BASE_URL}/collections`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        });

        if (response.ok) {
            collectionForm.reset();
            loadCollections();
        } else {
            showError('Failed to create collection');
        }
    } catch (error) {
        showError('Failed to create collection');
    }
});

// Transportation Management
const transportForm = document.getElementById('transportation-form');
const transportsTable = document.getElementById('transports-table').querySelector('tbody');

async function loadTransports() {
    try {
        const response = await fetch(`${API_BASE_URL}/transportations`);
        const transports = await response.json();
        transportsTable.innerHTML = transports.map(transport => `
            <tr>
                <td>${transport.id}</td>
                <td>${transport.vehicle.vehicle_number}</td>
                <td>${formatDate(transport.departure_time)}</td>
                <td><span class="badge badge-${transport.status.toLowerCase()}">${transport.status}</span></td>
                <td>
                    <button class="btn btn-sm btn-success" onclick="updateTransportStatus(${transport.id}, 'COMPLETED')">
                        Complete
                    </button>
                </td>
            </tr>
        `).join('');
    } catch (error) {
        showError('Failed to load transports');
    }
}

async function loadVehicles() {
    try {
        const response = await fetch(`${API_BASE_URL}/vehicles`);
        const vehicles = await response.json();
        const select = document.getElementById('transport-vehicle');
        select.innerHTML = vehicles.map(vehicle =>
            `<option value="${vehicle.id}">${vehicle.vehicle_number} - ${vehicle.type}</option>`
        ).join('');
    } catch (error) {
        showError('Failed to load vehicles');
    }
}

async function loadPendingCollections() {
    try {
        const response = await fetch(`${API_BASE_URL}/collections?status=PENDING`);
        const collections = await response.json();
        const select = document.getElementById('transport-collection');
        select.innerHTML = collections.map(collection =>
            `<option value="${collection.id}">ID: ${collection.id} - ${collection.location.name}</option>`
        ).join('');
    } catch (error) {
        showError('Failed to load pending collections');
    }
}

transportForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = {
        waste_collection_id: document.getElementById('transport-collection').value,
        vehicle_id: document.getElementById('transport-vehicle').value,
        departure_time: document.getElementById('transport-departure').value,
        destination: document.getElementById('transport-destination').value,
        status: 'IN_PROGRESS'
    };

    try {
        const response = await fetch(`${API_BASE_URL}/transportations`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        });

        if (response.ok) {
            transportForm.reset();
            loadTransports();
            loadPendingCollections();
        } else {
            showError('Failed to create transport');
        }
    } catch (error) {
        showError('Failed to create transport');
    }
});

async function updateTransportStatus(id, status) {
    try {
        const response = await fetch(`${API_BASE_URL}/transportations/${id}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ status })
        });

        if (response.ok) {
            loadTransports();
        } else {
            showError('Failed to update transport status');
        }
    } catch (error) {
        showError('Failed to update transport status');
    }
}

// Disposal Management
const disposalForm = document.getElementById('disposal-form');
const disposalsTable = document.getElementById('disposals-table').querySelector('tbody');

async function loadDisposals() {
    try {
        const response = await fetch(`${API_BASE_URL}/disposals`);
        const disposals = await response.json();
        disposalsTable.innerHTML = disposals.map(disposal => `
            <tr>
                <td>${formatDate(disposal.disposal_date)}</td>
                <td>${disposal.facility_name}</td>
                <td>${disposal.disposal_method}</td>
                <td>${disposal.quantity_disposed} kg</td>
                <td><span class="badge badge-${disposal.compliance_status.toLowerCase()}">${disposal.compliance_status}</span></td>
            </tr>
        `).join('');
    } catch (error) {
        showError('Failed to load disposals');
    }
}

async function loadCompletedTransports() {
    try {
        const response = await fetch(`${API_BASE_URL}/transportations?status=COMPLETED`);
        const transports = await response.json();
        const select = document.getElementById('disposal-transportation');
        select.innerHTML = transports.map(transport =>
            `<option value="${transport.id}">ID: ${transport.id} - ${transport.destination}</option>`
        ).join('');
    } catch (error) {
        showError('Failed to load completed transports');
    }
}

disposalForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = {
        transportation_id: document.getElementById('disposal-transportation').value,
        waste_category_id: document.getElementById('disposal-category').value,
        disposal_method: document.getElementById('disposal-method').value,
        disposal_date: new Date().toISOString(),
        quantity_disposed: document.getElementById('disposal-quantity').value,
        facility_name: document.getElementById('disposal-facility').value,
        treatment_method: document.getElementById('disposal-treatment').value,
        environmental_impact: document.getElementById('disposal-impact').value,
        disposal_cost: document.getElementById('disposal-cost').value || null,
        compliance_status: document.getElementById('disposal-compliance').value,
        notes: document.getElementById('disposal-notes').value
    };

    try {
        const response = await fetch(`${API_BASE_URL}/disposals`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        });

        if (response.ok) {
            disposalForm.reset();
            loadDisposals();
            loadCompletedTransports();
        } else {
            showError('Failed to create disposal record');
        }
    } catch (error) {
        showError('Failed to create disposal record');
    }
});

// Initial Load
document.addEventListener('DOMContentLoaded', () => {
    loadCollections();
    loadLocations();
    loadCategories();
    loadTransports();
    loadVehicles();
    loadPendingCollections();
    loadDisposals();
    loadCompletedTransports();
});
