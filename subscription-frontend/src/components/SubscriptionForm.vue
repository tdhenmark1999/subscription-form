<template>
  <div class="subscription-banner">
    <h1>NEWSLETTER</h1>
    <p class="description">Stay updated with our latest news and offers.</p>

    <form class="subscription-form" @submit.prevent="submitForm">
      <input type="text" placeholder="Name" v-model="name" required />
      <input type="email" placeholder="Email" v-model="email" required />

      <button type="submit" :disabled="isLoading">
        <span v-if="!isLoading">Subscribe</span>
        <span v-else class="loader"></span>
      </button>
    </form>

    <!-- Success and Error Dialogs -->
    <div v-if="successMessage" :class="['dialog', 'success-dialog', showSuccessDialog ? 'dialog-show' : '']">
      <p>{{ successMessage }}</p>
    </div>
    <div v-if="errorMessage" :class="['dialog', 'error-dialog', showErrorDialog ? 'dialog-show' : '']">
      <p>{{ errorMessage }}</p>
    </div>
  </div>
</template>

<script lang="ts">
import { ref } from 'vue';
import apiClient from '../axiosConfig';

export default {
  name: 'SubscriptionForm',
  setup() {
    const name = ref<string>('');
    const email = ref<string>('');
    const errorMessage = ref<string | null>(null);
    const successMessage = ref<string | null>(null);
    const isLoading = ref(false);
    const showSuccessDialog = ref(false);
    const showErrorDialog = ref(false);

    const submitForm = async () => {
      isLoading.value = true;
      errorMessage.value = successMessage.value = null;
      showErrorDialog.value = showSuccessDialog.value = false;

      try {
        await apiClient.post('/subscribe', { name: name.value, email: email.value });
        successMessage.value = 'Subscription Successful!';
        showSuccessDialog.value = true;

        setTimeout(() => {
          showSuccessDialog.value = false;
          successMessage.value = null;
        }, 3000);
      } catch (error: any) {
        errorMessage.value = error.response?.data?.message || 'An error occurred. Please try again.';
        showErrorDialog.value = true;

        setTimeout(() => {
          showErrorDialog.value = false;
          errorMessage.value = null;
        }, 3000);
      } finally {
        isLoading.value = false;
      }
    };

    return { name, email, submitForm, errorMessage, successMessage, isLoading, showSuccessDialog, showErrorDialog };
  }
};
</script>

<style lang="scss">
.subscription-banner {
    text-align: center;
    max-width: 600px;
    margin: auto;
    padding: 1.5rem;
    color: #fff;

    h1 {
      font-size: 1.5rem;
      margin-bottom: .2rem;
    }

    .description {
      font-size: 0.9rem;
      color: #fff;
      margin-bottom: 1.5rem;
    }
}

.subscription-form {
    display: flex;
    flex-direction: column;
    align-items: center;

    input {
        width: 100%;
        max-width: 400px;
        padding: 0.75rem;
        margin-bottom: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 0.95rem;
        background: transparent;
        color: white;
    }

    button {
        width: 100%;
        max-width: 400px;
        padding: 0.75rem;
        font-size: 0.75rem;
        background-color: #fff;
        color: black;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-weight: bold;
        text-transform: uppercase;
        margin-top:10px;
        position: relative;

        &:hover {
            background-color: #e0e0e0;
        }

        &:disabled {
            cursor: not-allowed;
        }

        .loader {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid #fff;
            border-top: 2px solid #333;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }
    }
}

.dialog {
  position: fixed;
  top: 20px;
  right: -300px; 
  padding: 1rem;
  border-radius: 8px;
  color: #fff;
  min-width: 200px;
  max-width: 300px;
  font-size: 0.9rem;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  z-index: 100;
  opacity: 0;
  transition: transform 0.5s ease, opacity 0.5s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.dialog-show {
  right: 20px;
  opacity: 1;
}

.success-dialog {
  background-color: #28a745;
}

.error-dialog {
  background-color: #dc3545;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

@media (max-width: 600px) {
  .subscription-banner {
    padding: 1rem;
  }

  .subscription-form input, 
  .subscription-form button {
    width: 100%;
  }
}
</style>
